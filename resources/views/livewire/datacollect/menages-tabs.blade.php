<x-slot name="titre">Menages</x-slot>

 <x-slot name="stitre">@include('livewire.beneficiaire.menu')</x-slot>
 <div>
  
<x-mtabs :tabs="[
    ['id' => 'toits', 'label' => 'Toits','content'=>'', 'component' => 'datacollect.toits.toit-liste'],
    
    ['id' => 'menages', 'label' => 'Menages','content'=>'', 'component' => 'datacollect.menages.menage-liste'],

   ['id' => 'membres', 'label' => 'Membres','content'=>'', 'component' => 'datacollect.membres.membre-liste'],
    
     
]" />  
</div>