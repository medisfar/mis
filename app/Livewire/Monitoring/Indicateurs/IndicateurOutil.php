<?php

namespace App\Livewire\Monitoring\Indicateurs;

use App\Models\Indicateur;
use App\Models\Projet;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class IndicateurOutil extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Locked]
    public bool $lectureSeule = false;

    public $search = '';
    public $editingId = null;
    public $detailId = null;
    public $showForm = false;

    public $nom = '';
    public $unite_mesure = '';
    public $frequence = '';
    public $niveau = '';
    public $source = '';
    public $baseline = '';
    public $valeur_cible = '';
    public $valeur_actuelle = '';
    public $periode = '';

    public function mount(bool $lectureSeule = false): void
    {
        $this->lectureSeule = $lectureSeule;
    }

    public function render()
    {
        $projetId = $this->currentProjectId();
        $query = Indicateur::query()->latest('id');

        if ($projetId) {
            $query->where('projet_id', $projetId);
        } else {
            $query->whereRaw('1 = 0');
        }

        $this->applySearch($query);

        return view('livewire.monitoring.indicateurs.indicateur-outil', [
            'indicateurs' => $query->paginate(10),
            'detail' => $this->detailId
                ? $this->projectQuery()->find($this->detailId)
                : null,
            'projet' => $projetId ? Projet::find($projetId) : null,
            'frequences' => Indicateur::frequences(),
            'niveaux' => Indicateur::niveaux(),
            'sources' => Indicateur::sources(),
        ]);
    }

    public function create()
    {
        if ($this->lectureSeule) {
            return;
        }

        $this->resetForm();
        $this->showForm = true;
    }

    public function edit($id)
    {
        if ($this->lectureSeule) {
            return;
        }

        $indicateur = $this->projectQuery()->findOrFail($id);

        $this->editingId = $indicateur->id;
        $this->nom = $indicateur->nom;
        $this->unite_mesure = $indicateur->unite_mesure;
        $this->frequence = (string) $indicateur->frequence;
        $this->niveau = (string) $indicateur->niveau;
        $this->source = (string) $indicateur->source;
        $this->baseline = $indicateur->baseline;
        $this->valeur_cible = $indicateur->valeur_cible;
        $this->valeur_actuelle = $indicateur->valeur_actuelle;
        $this->periode = $indicateur->periode;
        $this->showForm = true;
    }

    public function save()
    {
        if ($this->lectureSeule) {
            return;
        }

        $projetId = $this->currentProjectId();

        if (! $projetId) {
            $this->addError(
                'projet',
                'Veuillez choisir un projet avant de saisir un indicateur.'
            );

            return;
        }

        $data = $this->validate([
            'nom' => 'required|string|max:255',
            'unite_mesure' => 'nullable|string|max:50',
            'frequence' => ['required', Rule::in(array_keys(Indicateur::frequences()))],
            'niveau' => ['required', Rule::in(array_keys(Indicateur::niveaux()))],
            'source' => ['required', Rule::in(array_keys(Indicateur::sources()))],
            'baseline' => 'nullable|numeric',
            'valeur_cible' => 'nullable|numeric',
            'valeur_actuelle' => 'nullable|numeric',
            'periode' => 'nullable|string|max:100',
        ]);

        $data['projet_id'] = $projetId;
        $data['activite_id'] = null;
        $data['est_actif'] = true;

        if ($this->editingId) {
            $this->projectQuery()->findOrFail($this->editingId)->update($data);
        } else {
            Indicateur::create($data);
        }

        $this->resetForm();
        $this->dispatch(
            'notify',
            type: 'success',
            message: 'Indicateur enregistré avec succès.'
        );
    }

    public function showDetail($id)
    {
        $this->detailId = $this->projectQuery()->whereKey($id)->exists()
            ? $id
            : null;
    }

    public function hideDetail()
    {
        $this->detailId = null;
    }

    public function delete($id)
    {
        if ($this->lectureSeule) {
            return;
        }

        $this->projectQuery()->findOrFail($id)->delete();
        $this->hideDetail();
    }

    public function cancel()
    {
        $this->resetForm();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId',
            'nom',
            'unite_mesure',
            'frequence',
            'niveau',
            'source',
            'baseline',
            'valeur_cible',
            'valeur_actuelle',
            'periode',
        ]);

        $this->showForm = false;
    }

    private function currentProjectId(): ?int
    {
        $projetId = (int) session()->get('pid');

        if ($projetId <= 0 || ! Projet::whereKey($projetId)->exists()) {
            return null;
        }

        return $projetId;
    }

    private function projectQuery()
    {
        $query = Indicateur::query();
        $projetId = $this->currentProjectId();

        if ($projetId) {
            $query->where('projet_id', $projetId);
        } else {
            $query->whereRaw('1 = 0');
        }

        return $query;
    }

    private function applySearch($query): void
    {
        $search = trim($this->search);

        if ($search === '') {
            return;
        }

        $matchingFrequencies = $this->matchingCodes(
            Indicateur::frequences(),
            $search
        );
        $matchingLevels = $this->matchingCodes(Indicateur::niveaux(), $search);
        $matchingSources = $this->matchingCodes(Indicateur::sources(), $search);

        $query->where(function ($subQuery) use (
            $search,
            $matchingFrequencies,
            $matchingLevels,
            $matchingSources
        ) {
            $subQuery
                ->where('nom', 'like', '%'.$search.'%')
                ->orWhere('unite_mesure', 'like', '%'.$search.'%')
                ->orWhere('periode', 'like', '%'.$search.'%');

            if ($matchingFrequencies !== []) {
                $subQuery->orWhereIn('frequence', $matchingFrequencies);
            }

            if ($matchingLevels !== []) {
                $subQuery->orWhereIn('niveau', $matchingLevels);
            }

            if ($matchingSources !== []) {
                $subQuery->orWhereIn('source', $matchingSources);
            }
        });
    }

    private function matchingCodes(array $options, string $search): array
    {
        $needle = mb_strtolower($search);

        return array_keys(array_filter(
            $options,
            fn ($label) => str_contains(mb_strtolower($label), $needle)
        ));
    }
}
