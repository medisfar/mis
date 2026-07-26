<x-slot name="titre">Béneficiaires</x-slot>

 <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
 <div>
  <x-mtabs :tabs="[
   ['id' => 'eligibles', 'label' => 'Eligibles','content'=>'', 'component' => 'datacollect.menages.menage-liste',
     'params'=>['menages'=>\App\Models\Menage::all()]],
   ['id' => 'sites', 'label' => 'Sites','content'=>'', 'component' => 'datacollect.sites.site-liste',
     'params'=>['sites'=>\App\Models\Site::all()]],
      ['id' => 'groupements', 'label' => 'Groupements','content'=>'', 'component' => 'beneficiaire.groupements.groupement-liste',
     'params'=>['groupements'=>\App\Models\Groupement::all()]],
     
]" />  
  
</div>