<x-slot name="titre">Cadre resultats</x-slot>
<x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot><div>
<div><br><br>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.activites.activite-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button>
<br><br>
<div class="row">
    <x-rowb 
        label="CPU Traffic" 
        icon="bi bi-cpu" 
        value="10" 
        unit="%"
    />
    
    <x-rowb 
        label="Memory Usage" 
        icon="bi bi-cash" 
        value="45" 
        unit="$"
    />
    
    <x-rowb 
        label="Disk Space" 
        icon="bi bi-hdd-stack" 
        value="120" 
        unit="GB"
       
    />
    
    <x-rowb 
        label="Network" 
        icon="bi bi-people"
        value="54" 
        unit="Mbps"
    />
</div>
                    
<div class="row" style="background:blue; color:white">
</div>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped table-sm">
<tr>

	<th witdh="30%">Indicateur</th>
	<th>Baseline</th>
	<th>Cible</th>

</tr>
@php $rows= \App\Models\Indicateur::all(); @endphp
@foreach($rows as $item)
<tr>
	
	<td width="30%">{{$item->nom}}</td>
<td>{{$item->baseline}}{{$item->unite_mesure}}</td>
	
<td>{{$item->type_cible}}{{$item->unite_mesure}}</td>
</tr>
@endforeach
</table></div>

 </div>