<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Membre</th>
	<td>{{$credit->membre?->nom ?? 'Non attribué'}}</td>
</tr>
<tr>
	<th>Date_octroi</th>
	<td>{{$credit->date_octroi}}</td>
</tr>
<tr>
	<th>Date_premiere_echeance</th>
	<td>{{$credit->date_premiere_echeance}}</td>
</tr>
<tr>
	<th>Montant_echeance</th>
	<td>{{$credit->montant_echeance}}</td>
</tr>
<tr>
	<th>Nbre_echeance</th>
	<td>{{$credit->nbre_echeance}}</td>
</tr>
<tr>
	<th>Termine</th>
	<td>{{$credit->termine}}</td>
</tr>
</table>
<h5>Échéances</h5>
<div class="table-responsive">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Date échéance</th>
            <th>Paiements</th>
            <th>Montant</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($credit->echeances->sortBy("date_echeance") as $index => $echeance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $echeance->date_echeance }}</td>
                <td>
                    @if($echeance->paiement)
                        @php($paiement = $echeance->paiement)
                        <div>
                            <div><strong>Date :</strong> {{ $paiement->date_paiement }}</div>
                            <div><strong>Montant payé :</strong> {{ number_format($paiement->montant_paye, 0, ",", " ") }}</div>
                            <div><strong>Restant :</strong> {{ number_format($paiement->montant_restant, 0, ",", " ") }}</div>
                        </div>
                    @else
                        <span class="text-muted">Non payée</span>
                    @endif
                </td>
                <td>{{ number_format($echeance->montant_paye, 0, ",", " ") }}</td>
                <td>
                    @unless($echeance->paiement)
                    <button class="btn btn-sm btn-success"
                        wire:click="$dispatch('show-modal', {
                            title: 'Payer échéance',
                            content: {
                                type: 'component',
                                name: 'microfinance.paiements.paiement-add',
                                key: {{ rand(0,1000) }},
                                params: { credit_id: {{ $credit->id }}, echeance_id: {{ $echeance->id }} }
                            }
                        })">Payer</button>
                    @endunless
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Aucune échéance</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

<a class="btn btn-sm btn-primary" href="{{route('microfinance.credits')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.credits.edit',$credit->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyCredit({{$credit->id}})">Supprimer</button>  
</div>
