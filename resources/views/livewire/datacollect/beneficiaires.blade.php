<x-slot name="titre">Datacollect</x-slot>

 <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
 <div>
  <x-mtabs :tabs="[
   ['id' => 'eligibles', 'label' => 'Eligibles','content'=>'', 'component' => 'beneficiaire.menages.menage-liste',
     'params'=>['menages'=>\App\Models\Menage::all()]],
   ['id' => 'sites', 'label' => 'Sites','content'=>'', 'component' => 'beneficiaire.sites.site-liste',
     'params'=>['sites'=>\App\Models\Site::all()]],
      ['id' => 'groupements', 'label' => 'Groupements ccc','content'=>'', 'component' => 'projet.groupements.groupement-liste',
     'params'=>['groupements'=>\App\Models\Groupement::all()]],
     
]" />  
  
</div>