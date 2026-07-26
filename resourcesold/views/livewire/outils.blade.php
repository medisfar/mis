<div>
    {{-- Do your work, then step back. --}}
    <x-slot name="titre">Menages</x-slot>

<x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
 

<x-mtabs :tabs="[
   
   ['id' => 'groupes', 'label' => 'Groupement','content'=>'',
    'component' => 'beneficiaire.groupements.groupement-liste'],

   ['id' => 'sites', 'label'=> 'Sites','content'=>'',
    'component' => 'datacollect.sites.site-liste'],

   ['id' => 'typesession', 
    'label' => 'Type session' ,'content'=>'',
    'component' => 'projet.typesessions.typesession-liste'],
    
     ['id' => 'formulaires', 
    'label' => 'Formulaire' ,'content'=>'',
    'component' => 'datacollect.formulaires.formulaire-liste'],
    
    
]" />  




</div>
