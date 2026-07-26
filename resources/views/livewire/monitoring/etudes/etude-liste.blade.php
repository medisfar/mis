<x-slot name="stitre"> @include('livewire.reporting.menu')</x-slot><div><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'etude.etudes.etude-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">

    <div class="row">
    @foreach($etudes as $item)
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{$item->Projet->libelle??''}}</strong>
                <span class="badge badge-info float-right">{{$item->categorie}}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$item->nom}}</h5>
                
                
                <div class="mb-2">
                    <strong>Periode:</strong>
                    <p class="card-text">{{ date('M', strtotime($item->date_debut)) }}- {{ date('M-Y', strtotime($item->date_fin)) }}</p>
                </div>
                
                <div class="mb-2">
                    <strong>Statut:</strong>
                    <span class="badge badge-secondary">{{$item->lestatut}}</span>
                </div>
                
                <div class="mb-2">
                    <strong>Zones:</strong>
                    <p class="card-text">{{$item->Zones}}</p>
                </div>
                
                <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'etude.etudes.etude-show',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">voir</button>
                
                
               
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-4">
    {{$etudes->links()}}
</div>
</div>