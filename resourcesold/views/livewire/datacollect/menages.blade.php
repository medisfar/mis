<x-slot name="titre">Datacollect</x-slot>

 <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
 <div>
  <x-mtabs :tabs="[
    ['id' => 'toits', 'label' => 'Toits','content'=>'', 'component' => 'beneficiaire.toits.toit-liste',
     'params'=>['toits'=>\App\Models\Toit::all()]],
     ['id' => 'menages', 'label' => 'Menages','content'=>'', 'component' => 'beneficiaire.menages.menage-liste',
     'params'=>['menages'=>\App\Models\Menage::all()]],
   ['id' => 'membres', 'label' => 'Membres','content'=>'', 'component' => 'beneficiaire.membres.membre-liste',
     'params'=>['membres'=>\App\Models\Membre::all()]],
     
     
]" />  
  
</div>