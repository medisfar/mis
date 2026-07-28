<x-slot name="titre">PTPA - Suivi des activites</x-slot>
<x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>

@php
    $formatMoney = function ($value) {
        return number_format((float) ($value ?? 0), 0, ',', ' ');
    };

    $formatDate = function ($value) {
        if (!$value) {
            return '-';
        }

        try {
            return \Carbon\Carbon::parse($value)->format('d/m/Y');
        } catch (\Throwable $e) {
            return $value;
        }
    };

    $statusMeta = function ($activity) {
        $progress = (int) ($activity->completed ?? 0);
        $status = (int) ($activity->statut ?? 0);

        if ($progress >= 100 || $status === 2) {
            return ['label' => 'Terminee', 'class' => 'ptpa-status-done'];
        }

        if ($progress > 0 || $status === 1) {
            return ['label' => 'En cours', 'class' => 'ptpa-status-running'];
        }

        return ['label' => 'Non demarree', 'class' => 'ptpa-status-pending'];
    };

    $progressClass = function ($progress) {
        $progress = (int) $progress;

        if ($progress >= 75) {
            return 'ptpa-progress-good';
        }

        if ($progress >= 40) {
            return 'ptpa-progress-mid';
        }

        return 'ptpa-progress-low';
    };
@endphp

<div class="ptpa-page">
    <div class="ptpa-toolbar">
        <div>
            <div class="ptpa-eyebrow">Plan de Travail et Budget Annuel</div>
            <h2>Tableau PTPA</h2>
        </div>
        <div class="ptpa-toolbar-meta">
            <span>{{ $projet ? $projet->libelle : 'Projet non selectionne' }}</span>
        </div>
    </div>

    @if(!$projet)
        <div class="alert alert-warning mb-0">
            Aucun projet n'est selectionne. Veuillez choisir un projet pour afficher le PTPA.
        </div>
    @elseif($projet->composantes->isEmpty())
        <div class="alert alert-info mb-0">
            Aucune composante n'est encore rattachee a ce projet.
        </div>
    @else
        @php
            $allActivities = $projet->composantes->flatMap(function ($composante) {
                return $composante->activites;
            });
            $totalActivities = $allActivities->count();
            $completedActivities = $allActivities->filter(function ($activity) {
                return (int) ($activity->completed ?? 0) >= 100 || (int) ($activity->statut ?? 0) === 2;
            })->count();
            $runningActivities = $allActivities->filter(function ($activity) {
                $progress = (int) ($activity->completed ?? 0);
                $status = (int) ($activity->statut ?? 0);
                return ($progress > 0 && $progress < 100) || $status === 1;
            })->count();
            $globalPlanned = $allActivities->sum('budget');
            $globalPaid = $allActivities->sum(function ($activity) {
                return $activity->decaisse ?? 0;
            });
            $globalPaymentRate = $globalPlanned > 0 ? round(($globalPaid / $globalPlanned) * 100) : 0;
        @endphp

        <div class="ptpa-summary">
            <div class="ptpa-summary-item">
                <span>Total activites</span>
                <strong>{{ $totalActivities }}</strong>
            </div>
            <div class="ptpa-summary-item">
                <span>Terminees</span>
                <strong>{{ $completedActivities }}</strong>
            </div>
            <div class="ptpa-summary-item">
                <span>En cours</span>
                <strong>{{ $runningActivities }}</strong>
            </div>
            <div class="ptpa-summary-item">
                <span>Decaissement global</span>
                <strong>{{ $globalPaymentRate }}%</strong>
            </div>
        </div>

        @foreach($projet->composantes as $componentIndex => $composante)
            @php
                $activities = $composante->activites;
                $activityCount = $activities->count();
                $finishedCount = $activities->filter(function ($activity) {
                    return (int) ($activity->completed ?? 0) >= 100 || (int) ($activity->statut ?? 0) === 2;
                })->count();
                $plannedTotal = $activities->sum('budget');
                $engagedTotal = $activities->sum('engage');
                $paidTotal = $activities->sum(function ($activity) {
                    return $activity->decaisse ?? 0;
                });
                $paidRate = $plannedTotal > 0 ? round(($paidTotal / $plannedTotal) * 100) : 0;
                $componentTone = $componentIndex % 2 === 0 ? 'ptpa-band-blue' : 'ptpa-band-green';
            @endphp

            <section class="ptpa-component">
                <div class="ptpa-component-header {{ $componentTone }}">
                    <div class="ptpa-component-title">
                        <span class="ptpa-diamond"></span>
                        <span>{{ $composante->code ?? 'Composante' }} - {{ $composante->composante ?? $composante->description ?? 'Sans libelle' }}</span>
                    </div>
                    <div class="ptpa-component-stats">
                        <span><i class="bi bi-list-check"></i> {{ $activityCount }} activites</span>
                        <span><i class="bi bi-check-square"></i> {{ $finishedCount }} terminees</span>
                        <span><i class="bi bi-cash-coin"></i> Decaissement : {{ $paidRate }}%</span>
                    </div>
                </div>

                <div class="ptpa-table-wrap">
                    <table class="ptpa-table">
                        <thead>
                            <tr>
                                <th>Activite</th>
                                <th>Composante</th>
                                <th>Periode</th>
                                <th>Statut</th>
                                <th>Avancement</th>
                                <th>Prevu</th>
                                <th>Engage</th>
                                <th>Decaisse</th>
                                <th>Taux financier</th>
                                <th>Ecart</th>
                                <th>Observation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                                @php
                                    $progress = max(0, min(100, (int) ($activity->completed ?? 0)));
                                    $status = $statusMeta($activity);
                                    $rate = ($activity->budget ?? 0) > 0 ? round((($activity->decaisse ?? 0) / $activity->budget) * 100) : 0;
                                    $gap = (float) ($activity->budget ?? 0) - (float) ($activity->decaisse ?? 0);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="ptpa-activity-name">{{ $activity->activite }}</div>
                                        <div class="ptpa-subline">
                                            @if($activity->sousComposante)
                                                {{ $activity->sousComposante->code }}
                                                @if($activity->sousComposante->description)
                                                    - {{ $activity->sousComposante->description }}
                                                @endif
                                            @else
                                                Sous-composante non renseignée
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="ptpa-component-code">{{ $activity->composante->code ?? $composante->code ?? '-' }}</span>
                                    </td>
                                    <td class="ptpa-date">
                                        <span>{{ $formatDate($activity->date_debut) }}</span>
                                        <small>{{ $formatDate($activity->date_fin) }}</small>
                                    </td>
                                    <td>
                                        <span class="ptpa-status {{ $status['class'] }}">{{ $status['label'] }}</span>
                                    </td>
                                    <td>
                                        <div class="ptpa-progress">
                                            <div class="ptpa-progress-track">
                                                <div class="ptpa-progress-bar {{ $progressClass($progress) }}" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <span>{{ $progress }}%</span>
                                        </div>
                                    </td>
                                    <td class="ptpa-money">{{ $formatMoney($activity->budget) }}</td>
                                    <td class="ptpa-money">{{ $formatMoney($activity->engage) }}</td>
                                    <td class="ptpa-money">{{ $formatMoney($activity->decaisse) }}</td>
                                    <td>
                                        <span class="ptpa-rate {{ $rate >= 75 ? 'ptpa-rate-good' : ($rate >= 40 ? 'ptpa-rate-mid' : 'ptpa-rate-low') }}">{{ $rate }}%</span>
                                    </td>
                                    <td class="ptpa-money {{ $gap > 0 ? 'ptpa-gap-positive' : 'ptpa-gap-zero' }}">{{ $formatMoney($gap) }}</td>
                                    <td class="ptpa-observation">
                                        @if($progress >= 100)
                                            Activite realisee.
                                        @elseif($progress > 0)
                                            Suivi en cours.
                                        @else
                                            A renseigner.
                                        @endif
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            class="ptpa-action"
                                            wire:click="$dispatch('show-modal', {
                                                title: 'Suivi de l activite',
                                                content: {
                                                    type: 'component',
                                                    name: 'monitoring.ptpa-activite-detail',
                                                    key: 'ptpa-activite-{{ $activity->id }}',
                                                    params: { id: {{ $activity->id }} }
                                                },
                                                size: 'modal-lg'
                                            })"
                                        >
                                            Voir
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="ptpa-empty">Aucune activite pour cette composante.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endforeach
    @endif
</div>

@push('mescss')
<style>
.ptpa-page {
    color: #0f2a45;
}

.ptpa-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 18px;
}

.ptpa-eyebrow {
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0;
    text-transform: uppercase;
}

.ptpa-toolbar h2 {
    margin: 2px 0 0;
    font-size: 24px;
    font-weight: 800;
}

.ptpa-toolbar-meta {
    background: #ffffff;
    border: 1px solid #d9e2ec;
    border-radius: 8px;
    padding: 8px 12px;
    font-weight: 700;
    color: #24425f;
}

.ptpa-component {
    margin-bottom: 24px;
}

.ptpa-summary {
    display: grid;
    grid-template-columns: repeat(4, minmax(150px, 1fr));
    gap: 12px;
    margin-bottom: 18px;
}

.ptpa-summary-item {
    background: #ffffff;
    border: 1px solid #d9e2ec;
    border-left: 4px solid #173f73;
    border-radius: 8px;
    padding: 12px 14px;
}

.ptpa-summary-item span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
}

.ptpa-summary-item strong {
    display: block;
    color: #0f2a45;
    font-size: 24px;
    line-height: 1.2;
    margin-top: 4px;
}

.ptpa-component-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    padding: 14px 18px;
    border-radius: 8px 8px 0 0;
    color: #ffffff;
}

.ptpa-band-blue {
    background: #173f73;
}

.ptpa-band-green {
    background: #1f6f31;
}

.ptpa-component-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 800;
}

.ptpa-diamond {
    width: 12px;
    height: 12px;
    background: #60a5fa;
    transform: rotate(45deg);
    border-radius: 2px;
    flex: 0 0 auto;
}

.ptpa-component-stats {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.ptpa-component-stats span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.14);
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 700;
}

.ptpa-table-wrap {
    overflow-x: auto;
    background: #ffffff;
    border: 1px solid #d8e1eb;
    border-top: 0;
}

.ptpa-table {
    width: 100%;
    min-width: 1420px;
    border-collapse: collapse;
    background: #ffffff;
}

.ptpa-table th {
    background: #173f73;
    color: #ffffff;
    padding: 13px 14px;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
}

.ptpa-table td {
    padding: 14px;
    border-bottom: 1px solid #dbe4ef;
    vertical-align: middle;
    font-size: 14px;
}

.ptpa-activity-name {
    font-weight: 800;
    color: #102f4e;
    max-width: 260px;
}

.ptpa-subline {
    display: inline-block;
    margin-top: 6px;
    padding: 3px 7px;
    border-radius: 5px;
    background: #eaf2ff;
    color: #17457a;
    font-size: 12px;
    font-weight: 800;
}

.ptpa-component-code {
    display: inline-block;
    padding: 5px 8px;
    border-radius: 6px;
    background: #eef6ff;
    color: #17457a;
    font-size: 12px;
    font-weight: 900;
    white-space: nowrap;
}

.ptpa-date span,
.ptpa-date small {
    display: block;
    white-space: nowrap;
}

.ptpa-date small {
    color: #64748b;
    margin-top: 3px;
}

.ptpa-status {
    display: inline-flex;
    align-items: center;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.ptpa-status-done {
    background: #dff3e4;
    color: #176b2c;
}

.ptpa-status-running {
    background: #e0f2fe;
    color: #0369a1;
}

.ptpa-status-pending {
    background: #f1f5f9;
    color: #475569;
}

.ptpa-progress {
    min-width: 150px;
}

.ptpa-progress-track {
    height: 10px;
    background: #e7edf3;
    border-radius: 999px;
    overflow: hidden;
}

.ptpa-progress-bar {
    height: 100%;
    border-radius: 999px;
}

.ptpa-progress-good {
    background: #57ad63;
}

.ptpa-progress-mid {
    background: #3b9eea;
}

.ptpa-progress-low {
    background: #f59e0b;
}

.ptpa-progress span {
    display: block;
    margin-top: 5px;
    text-align: center;
    font-weight: 800;
    color: #475569;
    font-size: 12px;
}

.ptpa-money {
    text-align: right;
    font-weight: 800;
    white-space: nowrap;
}

.ptpa-gap-positive {
    color: #9a3412;
}

.ptpa-gap-zero {
    color: #166534;
}

.ptpa-rate {
    display: inline-block;
    min-width: 48px;
    text-align: center;
    border-radius: 999px;
    padding: 5px 8px;
    font-weight: 800;
}

.ptpa-rate-good {
    background: #dcfce7;
    color: #166534;
}

.ptpa-rate-mid {
    background: #ffedd5;
    color: #c2410c;
}

.ptpa-rate-low {
    background: #ffe4e6;
    color: #be123c;
}

.ptpa-observation {
    color: #52657a;
    min-width: 160px;
}

.ptpa-empty {
    color: #64748b;
    text-align: center;
    font-weight: 700;
}

.ptpa-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 58px;
    border: 0;
    border-radius: 6px;
    padding: 6px 10px;
    background: #173f73;
    color: #ffffff;
    cursor: pointer;
    font-weight: 800;
    text-decoration: none;
}

.ptpa-action:hover {
    background: #0f2f57;
    color: #ffffff;
    text-decoration: none;
}

@media (max-width: 768px) {
    .ptpa-toolbar,
    .ptpa-component-header {
        align-items: stretch;
        flex-direction: column;
    }

    .ptpa-summary {
        grid-template-columns: 1fr;
    }

    .ptpa-component-stats {
        justify-content: flex-start;
    }
}
</style>
@endpush
