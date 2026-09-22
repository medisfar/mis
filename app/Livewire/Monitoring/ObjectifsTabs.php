<?php

namespace App\Livewire\Monitoring;

use App\Models\Activite;
use App\Models\ActiviteProduit;
use App\Models\Localite;
use App\Models\Mission;
use App\Models\Odd;
use App\Models\Prefecture;
use App\Models\Projet;
use App\Models\Region;
use App\Models\Resultat;
use App\Models\Ssprefecture;
use Livewire\Component;

class ObjectifsTabs extends Component
{
    public string $search = '';
    public $mission_id = '';
    public $resultat_id = '';
    public $odd_id = '';
    public $projet_id = '';
    public $region_id = '';
    public $prefecture_id = '';
    public $ssprefecture_id = '';
    public $localite_id = '';
    public $periode = '';
    public array $openMissions = [];
    public array $openResultats = [];

    public function updatedMissionId(): void
    {
        $this->resultat_id = '';
    }

    public function updatedRegionId(): void
    {
        $this->prefecture_id = '';
        $this->ssprefecture_id = '';
        $this->localite_id = '';
    }

    public function updatedPrefectureId(): void
    {
        $this->ssprefecture_id = '';
        $this->localite_id = '';
    }

    public function updatedSsprefectureId(): void
    {
        $this->localite_id = '';
    }

    public function resetFilters(): void
    {
        $this->reset([
            'search', 'mission_id', 'resultat_id', 'odd_id', 'projet_id',
            'region_id', 'prefecture_id', 'ssprefecture_id', 'localite_id',
            'periode',
        ]);
    }

    public function toggleMission(int $missionId): void
    {
        if (in_array($missionId, $this->openMissions, true)) {
            $this->openMissions = array_values(array_diff($this->openMissions, [$missionId]));
            return;
        }

        $this->openMissions[] = $missionId;
    }

    public function toggleResultat(int $resultatId): void
    {
        if (in_array($resultatId, $this->openResultats, true)) {
            $this->openResultats = array_values(array_diff($this->openResultats, [$resultatId]));
            return;
        }

        $this->openResultats[] = $resultatId;
    }

    private function filteredQuery()
    {
        return ActiviteProduit::query()
            // L'affichage décisionnel ne doit pas compter les références orphelines.
            ->whereHas('produit.resultat.mission')
            ->whereHas('activite')
            ->with([
                'produit.resultat.mission',
                'produit.resultat.odds',
                'activite.composante.projet',
                'activite.taches.site.localite.ssprefecture.prefecture.region',
            ])
            ->when($this->search, function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(function ($query) use ($term) {
                    $query->where('commentaire', 'like', $term)
                        ->orWhereHas('produit', fn ($q) => $q->where('description', 'like', $term))
                        ->orWhereHas('produit.resultat', fn ($q) => $q->where('description', 'like', $term))
                        ->orWhereHas('produit.resultat.mission', fn ($q) => $q->where('libelle', 'like', $term))
                        ->orWhereHas('activite', fn ($q) => $q->where('activite', 'like', $term))
                        ->orWhereHas('activite.composante.projet', fn ($q) => $q->where('libelle', 'like', $term));
                });
            })
            ->when($this->mission_id, fn ($query) => $query->whereHas(
                'produit.resultat',
                fn ($resultat) => $resultat->where('mission_id', $this->mission_id)
            ))
            ->when($this->resultat_id, fn ($query) => $query->whereHas(
                'produit',
                fn ($produit) => $produit->where('resultat_id', $this->resultat_id)
            ))
            ->when($this->odd_id, fn ($query) => $query->whereHas(
                'produit.resultat.odds',
                fn ($odd) => $odd->where('odds.id', $this->odd_id)
            ))
            ->when($this->projet_id, fn ($query) => $query->whereHas(
                'activite.composante',
                fn ($composante) => $composante->where('projet_id', $this->projet_id)
            ))
            ->when($this->region_id, fn ($query) => $query->whereHas(
                'activite.taches.site.localite.ssprefecture.prefecture',
                fn ($prefecture) => $prefecture->where('region_id', $this->region_id)
            ))
            ->when($this->prefecture_id, fn ($query) => $query->whereHas(
                'activite.taches.site.localite.ssprefecture',
                fn ($ssprefecture) => $ssprefecture->where('prefecture_id', $this->prefecture_id)
            ))
            ->when($this->ssprefecture_id, fn ($query) => $query->whereHas(
                'activite.taches.site.localite',
                fn ($localite) => $localite->where('ssprefecture_id', $this->ssprefecture_id)
            ))
            ->when($this->localite_id, fn ($query) => $query->whereHas(
                'activite.taches.site',
                fn ($site) => $site->where('localite_id', $this->localite_id)
            ))
            ->when($this->periode, fn ($query) => $query->whereHas(
                'activite',
                fn ($activite) => $activite->whereYear('date_fin', $this->periode)
            ));
    }

    private function groupKey(ActiviteProduit $row): string
    {
        return base64_encode(json_encode([
            $row->produit_id,
            optional($row->activite)->date_fin
                ? \Carbon\Carbon::parse($row->activite->date_fin)->format('Y')
                : null,
            $row->unite,
        ], JSON_UNESCAPED_UNICODE));
    }

    public function render()
    {
        $rows = $this->filteredQuery()->get();

        $groups = $rows
            ->groupBy(fn (ActiviteProduit $row) => $this->groupKey($row))
            ->map(function ($contributions, $key) {
                $first = $contributions->first();
                $projects = $contributions
                    ->map(fn ($row) => $row->activite?->composante?->projet)
                    ->filter()
                    ->unique('id')
                    ->values();

                return (object) [
                    'key' => $key,
                    'produit' => $first->produit,
                    'periode' => $first->activite?->date_fin
                        ? \Carbon\Carbon::parse($first->activite->date_fin)->format('Y')
                        : 'Null',
                    'periode_tri' => $first->activite?->date_fin ?: '0000-00-00',
                    'indicateur_realise' => $contributions->sum('indicateur_realise'),
                    'unite' => $first->unite,
                    'cout' => $contributions->sum('cout'),
                    'nombre_activites' => $contributions->pluck('activite_id')->unique()->count(),
                    'nombre_projets' => $projects->count(),
                    'contributions' => $contributions,
                ];
            })
            ->sortByDesc('periode_tri')
            ->values();

        $statistics = function ($groupes): array {
            $contributions = $groupes
                ->flatMap(fn ($groupe) => $groupe->contributions)
                ->unique('id');
            $sites = $contributions
                ->flatMap(fn ($row) => $row->activite?->taches?->pluck('site') ?? collect())
                ->filter()
                ->unique('id');

            return [
                'produits' => $contributions->pluck('produit_id')->filter()->unique()->count(),
                'projets' => $contributions
                    ->map(fn ($row) => $row->activite?->composante?->projet?->id)
                    ->filter()->unique()->count(),
                'activites' => $contributions->pluck('activite_id')->filter()->unique()->count(),
                'ssprefectures' => $sites
                    ->map(fn ($site) => $site->localite?->ssprefecture_id)
                    ->filter()->unique()->count(),
                'localites' => $sites->pluck('localite_id')->filter()->unique()->count(),
                'cout' => $contributions->sum('cout'),
            ];
        };

        $groupsByMission = $groups->groupBy(
            fn ($groupe) => $groupe->produit->resultat->mission_id
        );

        // La hiérarchie part des référentiels afin d'afficher aussi les niveaux vides.
        $missionsHierarchy = Mission::with(['resultats.odds'])
            ->orderBy('id')
            ->get()
            ->map(function ($mission) use ($groupsByMission, $statistics) {
                $missionGroups = $groupsByMission->get($mission->id, collect());
                $groupsByResultat = $missionGroups->groupBy(
                    fn ($groupe) => $groupe->produit->resultat_id
                );

                $resultats = $mission->resultats
                    ->map(function ($resultat) use ($groupsByResultat, $statistics) {
                        $resultatGroups = $groupsByResultat->get($resultat->id, collect());

                        return (object) [
                            'resultat' => $resultat,
                            'statistiques' => $statistics($resultatGroups),
                            'produits' => $resultatGroups->values(),
                        ];
                    })
                    ->sortBy(fn ($item) => $item->resultat->position ?? $item->resultat->id)
                    ->values();

                return (object) [
                    'mission' => $mission,
                    'statistiques' => $statistics($missionGroups),
                    'resultats' => $resultats,
                ];
            })
            ->sortBy(fn ($item) => $item->mission->id)
            ->values();

        return view('livewire.monitoring.objectifs-tabs', [
            'missionsHierarchy' => $missionsHierarchy,
            'missions' => Mission::orderBy('libelle')->get(),
            'resultats' => Resultat::when(
                $this->mission_id,
                fn ($query) => $query->where('mission_id', $this->mission_id)
            )->orderBy('description')->get(),
            'odds' => Odd::orderBy('nom')->get(),
            'projets' => Projet::orderBy('libelle')->get(),
            'regions' => Region::orderBy('nom_region')->get(),
            'prefectures' => Prefecture::when(
                $this->region_id,
                fn ($query) => $query->where('region_id', $this->region_id)
            )->orderBy('nom_prefecture')->get(),
            'ssprefectures' => Ssprefecture::when(
                $this->prefecture_id,
                fn ($query) => $query->where('prefecture_id', $this->prefecture_id)
            )->orderBy('nom_ssprefecture')->get(),
            'localites' => Localite::when(
                $this->ssprefecture_id,
                fn ($query) => $query->where('ssprefecture_id', $this->ssprefecture_id)
            )->orderBy('nom_localite')->get(),
            'periodes' => Activite::whereNotNull('date_fin')
                ->selectRaw("YEAR(date_fin) as valeur, YEAR(date_fin) as libelle")
                ->distinct()
                ->orderByDesc('valeur')
                ->get(),
            'totalCout' => $rows->sum('cout'),
            'nombreProduits' => $rows->pluck('produit_id')->unique()->count(),
            'nombreProjets' => $rows
                ->map(fn ($row) => $row->activite?->composante?->projet?->id)
                ->filter()->unique()->count(),
            'nombreResultats' => $rows
                ->map(fn ($row) => $row->produit?->resultat_id)
                ->filter()->unique()->count(),
            'nombreMissions' => $rows
                ->map(fn ($row) => $row->produit?->resultat?->mission_id)
                ->filter()->unique()->count(),
        ]);
    }
}
