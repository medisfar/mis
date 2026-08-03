<?php

namespace App\Livewire\Monitoring\Indicateurs;

use App\Models\Indicateur;
use App\Models\Ivaleur;
use App\Models\Projet;
use Carbon\Carbon;
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
    public $showValuesModal = false;
    public $valuesIndicatorId = null;
    public $editingValueId = null;
    public $valuePeriod = '';
    public $valueTarget = '';
    public $valueRealized = '';

    public $nom = '';
    public $unite_mesure = '';
    public $frequence = '';
    public $niveau = '';
    public $source = '';
    public $baseline = '';
    public $valeur_cible = '';
    public $periode = '';

    public function mount(bool $lectureSeule = false): void
    {
        $this->lectureSeule = $lectureSeule;
    }

    public function render()
    {
        $projetId = $this->currentProjectId();
        $query = Indicateur::query()
            ->withSum('valeurs as cible_periodique_totale', 'valeur_cible')
            ->withSum('valeurs as realise_periodique_total', 'valeur')
            ->latest('id');

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
            'valuesIndicator' => $this->valuesIndicator(),
            'periodicValues' => $this->periodicValues(),
            'periodOptions' => $this->periodOptions(),
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

    public function openValues(int $id): void
    {
        $indicateur = $this->projectQuery()->findOrFail($id);

        $this->resetValueForm();
        $this->valuesIndicatorId = $indicateur->id;
        $this->showValuesModal = true;
    }

    public function closeValues(): void
    {
        $this->showValuesModal = false;
        $this->valuesIndicatorId = null;
        $this->resetValueForm();
    }

    public function editValue(int $id): void
    {
        if ($this->lectureSeule) {
            return;
        }

        $value = $this->valueQuery()->findOrFail($id);

        $this->editingValueId = $value->id;
        $this->valuePeriod = $value->periode;
        $this->valueTarget = $value->valeur_cible;
        $this->valueRealized = $value->valeur;
        $this->resetValidation();
    }

    public function saveValue(): void
    {
        if ($this->lectureSeule) {
            return;
        }

        $indicateur = $this->valuesIndicator();

        if (! $indicateur) {
            $this->addError('valuePeriod', 'Indicateur introuvable pour le projet actif.');
            return;
        }

        $data = $this->validate([
            'valuePeriod' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ivaleurs', 'periode')
                    ->where(fn ($query) => $query->where('indicateur_id', $indicateur->id))
                    ->ignore($this->editingValueId),
            ],
            'valueTarget' => 'required|numeric|min:0',
            'valueRealized' => 'required|numeric|min:0',
        ], [], [
            'valuePeriod' => 'periode',
            'valueTarget' => 'valeur cible',
            'valueRealized' => 'valeur realisee',
        ]);

        $payload = [
            'indicateur_id' => $indicateur->id,
            'periode' => trim($data['valuePeriod']),
            'valeur_cible' => (int) round((float) $data['valueTarget']),
            'valeur' => (int) round((float) $data['valueRealized']),
        ];

        if ($this->editingValueId) {
            $this->valueQuery()->findOrFail($this->editingValueId)->update($payload);
        } else {
            Ivaleur::create($payload);
        }

        $this->resetValueForm();
        $this->dispatch('notify', type: 'success', message: 'Valeur periodique enregistree avec succes.');
    }

    public function deleteValue(int $id): void
    {
        if ($this->lectureSeule) {
            return;
        }

        $this->valueQuery()->findOrFail($id)->delete();
        $this->resetValueForm();
    }

    public function cancelValueEdit(): void
    {
        $this->resetValueForm();
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
            'periode',
        ]);

        $this->showForm = false;
    }

    private function resetValueForm(): void
    {
        $this->reset(['editingValueId', 'valuePeriod', 'valueTarget', 'valueRealized']);
        $this->resetValidation();
    }

    private function valuesIndicator(): ?Indicateur
    {
        if (! $this->showValuesModal || ! $this->valuesIndicatorId) {
            return null;
        }

        return $this->projectQuery()->find($this->valuesIndicatorId);
    }

    private function valueQuery()
    {
        return Ivaleur::query()->where('indicateur_id', $this->valuesIndicatorId);
    }

    private function periodicValues()
    {
        if (! $this->showValuesModal || ! $this->valuesIndicatorId) {
            return collect();
        }

        return $this->valueQuery()->orderBy('id')->get();
    }

    private function periodOptions(): array
    {
        $indicateur = $this->valuesIndicator();
        $projet = $indicateur?->projet;

        if (! $indicateur || ! $projet?->date_debut || ! $projet?->date_fin) {
            return [];
        }

        $start = Carbon::parse($projet->date_debut)->startOfMonth();
        $end = Carbon::parse($projet->date_fin)->endOfMonth();
        $monthsPerPeriod = match ((string) $indicateur->frequence) {
            '0' => 1,
            '1' => 3,
            '2' => 6,
            '3' => 12,
            '4' => 2,
            default => 1,
        };
        $cursor = $start->copy();
        $options = [];

        while ($cursor->lte($end)) {
            $periodEnd = $cursor->copy()->addMonths($monthsPerPeriod - 1)->endOfMonth();
            if ($periodEnd->gt($end)) {
                $periodEnd = $end->copy();
            }

            $options[] = $this->periodLabel($cursor, $periodEnd, $monthsPerPeriod);
            $cursor->addMonths($monthsPerPeriod)->startOfMonth();
        }

        return array_values(array_unique($options));
    }

    private function periodLabel(Carbon $start, Carbon $end, int $months): string
    {
        $monthNames = [
            1 => 'Janvier', 2 => 'Fevrier', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Aout',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Decembre',
        ];

        if ($months === 1) {
            return $monthNames[$start->month].' '.$start->year;
        }

        if ($months === 12 && $start->month === 1 && $end->month === 12) {
            return 'Annee '.$start->year;
        }

        $label = $monthNames[$start->month].' - '.$monthNames[$end->month];
        return $start->year === $end->year
            ? $label.' '.$end->year
            : $label.' '.$start->year.' / '.$end->year;
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
