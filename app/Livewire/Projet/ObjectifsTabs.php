<?php

namespace App\Livewire\Projet;

use App\Models\Activite;
use App\Models\ActiviteProduit;
use App\Models\Localite;
use App\Models\Mission;
use App\Models\Odd;
use App\Models\Produit;
use App\Models\Resultat;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ObjectifsTabs extends Component
{
    public string $activeTab = 'missions';
    public ?int $editingId = null;

    public string $libelle = '';
    public string $description = '';
    public ?int $mission_id = null;
    public array $odd_ids = [];
    public ?int $resultat_id = null;

    public ?int $contributionId = null;
    public ?int $contribution_produit_id = null;
    public ?int $activite_id = null;
    public ?int $ssprefecture_id = null;
    public ?int $localite_id = null;
    public $indicateur_realise = null;
    public string $unite = '';
    public $cout = null;
    public string $commentaire = '';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetEditor();
    }

    public function resetEditor(): void
    {
        $this->resetValidation();
        $this->editingId = null;
        $this->libelle = '';
        $this->description = '';
        $this->mission_id = null;
        $this->odd_ids = [];
        $this->resultat_id = null;
    }

    public function editMission(int $id): void
    {
        $mission = Mission::findOrFail($id);
        $this->editingId = $id;
        $this->libelle = $mission->libelle;
        $this->description = $mission->description;
    }

    public function saveMission(): void
    {
        $data = $this->validate([
            'libelle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        Mission::updateOrCreate(['id' => $this->editingId], $data);
        session()->flash('objectifs_message', 'Mission enregistrée.');
        $this->resetEditor();
    }

    public function editOdd(int $id): void
    {
        $odd = Odd::findOrFail($id);
        $this->editingId = $id;
        $this->libelle = $odd->nom;
    }

    public function saveOdd(): void
    {
        $this->validate(['libelle' => ['required', 'string', 'max:255']]);
        Odd::updateOrCreate(['id' => $this->editingId], ['nom' => $this->libelle]);
        session()->flash('objectifs_message', 'ODD enregistré.');
        $this->resetEditor();
    }

    public function editResultat(int $id): void
    {
        $resultat = Resultat::with('odds')->findOrFail($id);
        $this->editingId = $id;
        $this->description = $resultat->description;
        $this->mission_id = $resultat->mission_id;
        $this->odd_ids = $resultat->odds->pluck('id')->map(fn ($id) => (string) $id)->all();
    }

    public function saveResultat(): void
    {
        $data = $this->validate([
            'description' => ['required', 'string', 'max:255'],
            'mission_id' => ['required', 'exists:missions,id'],
            'odd_ids' => ['array'],
            'odd_ids.*' => ['exists:odds,id'],
        ]);

        $position = $this->editingId
            ? Resultat::findOrFail($this->editingId)->position
            : ((int) Resultat::where('mission_id', $data['mission_id'])->max('position') + 1);

        $resultat = Resultat::updateOrCreate(
            ['id' => $this->editingId],
            [
                'description' => $data['description'],
                'mission_id' => $data['mission_id'],
                'position' => $position,
            ]
        );
        $resultat->odds()->sync($data['odd_ids'] ?? []);

        session()->flash('objectifs_message', 'Résultat enregistré.');
        $this->resetEditor();
    }

    public function editProduit(int $id): void
    {
        $produit = Produit::findOrFail($id);
        $this->editingId = $id;
        $this->description = $produit->description;
        $this->resultat_id = $produit->resultat_id;
    }

    public function saveProduit(): void
    {
        $data = $this->validate([
            'description' => ['required', 'string', 'max:255'],
            'resultat_id' => ['required', 'exists:resultats,id'],
        ]);

        Produit::updateOrCreate(['id' => $this->editingId], $data);
        session()->flash('objectifs_message', 'Produit enregistré.');
        $this->resetEditor();
    }

    public function editContribution(?int $id = null, ?int $produitId = null): void
    {
        $this->resetContribution();
        if ($id) {
            $contribution = ActiviteProduit::findOrFail($id);
            $this->contributionId = $id;
            $this->contribution_produit_id = $contribution->produit_id;
            $this->activite_id = $contribution->activite_id;
            $this->ssprefecture_id = $contribution->ssprefecture_id;
            $this->localite_id = $contribution->localite_id;
            $this->indicateur_realise = $contribution->indicateur_realise;
            $this->unite = $contribution->unite ?? '';
            $this->cout = $contribution->cout;
            $this->commentaire = $contribution->commentaire ?? '';
        } else {
            $this->contribution_produit_id = $produitId;
        }
    }

    public function updatedLocaliteId($value): void
    {
        if ($value) {
            $this->ssprefecture_id = Localite::find($value)?->ssprefecture_id;
        }
    }

    public function saveContribution(): void
    {
        $data = $this->validate([
            'contribution_produit_id' => ['required', 'exists:produits,id'],
            'activite_id' => ['required', 'exists:activites,id'],
            'ssprefecture_id' => ['required', 'exists:ssprefectures,id'],
            'localite_id' => [
                'nullable',
                Rule::exists('localites', 'id')->where(
                    fn ($query) => $query->where('ssprefecture_id', $this->ssprefecture_id)
                ),
            ],
            'indicateur_realise' => ['required', 'numeric', 'min:0'],
            'unite' => ['required', 'string', 'max:100'],
            'cout' => ['required', 'numeric', 'min:0'],
            'commentaire' => ['nullable', 'string'],
        ]);

        $activite = Activite::findOrFail($data['activite_id']);
        $dejaAffecte = ActiviteProduit::where('activite_id', $activite->id)
            ->when($this->contributionId, fn ($query) => $query->where('id', '!=', $this->contributionId))
            ->sum('cout');

        if (($dejaAffecte + (float) $data['cout']) > (float) $activite->budget) {
            $this->addError(
                'cout',
                'Le coût dépasse le budget disponible de cette activité ('.number_format(
                    max(0, $activite->budget - $dejaAffecte),
                    0,
                    ',',
                    ' '
                ).').'
            );
            return;
        }

        ActiviteProduit::updateOrCreate(
            ['id' => $this->contributionId],
            [
                'produit_id' => $data['contribution_produit_id'],
                'activite_id' => $data['activite_id'],
                'ssprefecture_id' => $data['ssprefecture_id'],
                'localite_id' => $data['localite_id'] ?: null,
                'indicateur_realise' => $data['indicateur_realise'],
                'unite' => $data['unite'],
                'cout' => $data['cout'],
                'commentaire' => $data['commentaire'] ?: null,
            ]
        );

        session()->flash('objectifs_message', 'Contribution au produit enregistrée.');
        $this->resetContribution();
    }

    public function resetContribution(): void
    {
        $this->resetValidation();
        $this->contributionId = null;
        $this->contribution_produit_id = null;
        $this->activite_id = null;
        $this->ssprefecture_id = null;
        $this->localite_id = null;
        $this->indicateur_realise = null;
        $this->unite = '';
        $this->cout = null;
        $this->commentaire = '';
    }

    public function deleteContribution(int $id): void
    {
        ActiviteProduit::findOrFail($id)->delete();
        session()->flash('objectifs_message', 'Contribution supprimée.');
    }

    public function render()
    {
        return view('livewire.projet.objectifs-tabs', [
            'missions' => Mission::withCount('resultats')->orderBy('id')->get(),
            'odds' => Odd::withCount('resultats')->orderBy('id')->get(),
            'resultats' => Resultat::with(['mission', 'odds'])->withCount('produits')
                ->orderBy('mission_id')->orderBy('position')->get(),
            'produits' => Produit::with([
                'resultat.mission',
                'contributions.activite.composante.projet',
                'contributions.ssprefecture',
                'contributions.localite',
            ])->orderBy('description')->get(),
            'activites' => Activite::with('composante.projet')->orderBy('activite')->get(),
        ]);
    }
}
