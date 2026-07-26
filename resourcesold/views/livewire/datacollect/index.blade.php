
  
     
      ['id' => 'groupements', 'label' => 'Groupements','content'=>'', 'component' => 'beneficiaire.groupements.groupement-liste',
     'params'=>['groupements'=>\App\Models\Groupement::all()]],
     'params'=>['membres'=>\App\Models\Membre::all()]],
     'params'=>['menages'=>\App\Models\Menage::all()]],
     'params'=>['toits'=>\App\Models\Toit::all()]],
     ['id' => 'menages', 'label' => 'Menages','content'=>'', 'component' => 'datacollect.menages.menage-liste',
    ['id' => 'toits', 'label' => 'Toits','content'=>'', 'component' => 'beneficiaire.toits.toit-liste',
   ['id' => 'membres', 'label' => 'Membres','content'=>'', 'component' => 'datacollect.membres.membre-liste',
 <div>
 <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
</div>
<x-mtabs :tabs="[
<x-slot name="titre">Datacollect</x-slot>
]" />  