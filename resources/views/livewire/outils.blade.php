<x-slot name="titre">Outils</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot><div>
<div>
 

<x-mtabs :tabs="[
   
   ['id' => 'groupes', 'label' => 'Groupement','content'=>'',
    'component' => 'beneficiaire.groupements.groupement-liste'],
    ['id' => 'menagses', 'label' => 'Menages','content'=>'',
    'component' => 'datacollect.menages.menage-liste'],
   ['id' => 'sites', 'label'=> 'Sites','content'=>'',
    'component' => 'datacollect.sites.site-liste'],

   ['id' => 'typesession', 
    'label' => 'Type session' ,'content'=>'',
    'component' => 'projet.typesessions.typesession-liste'],
    
     ['id' => 'formulaires', 
    'label' => 'Formulaire' ,'content'=>'',
    'component' => 'datacollect.formulaires.formulaire-liste'],
    
    
     ['id' => 'docs', 'label' => 'Document','content'=>'',
    'component' => 'projet.documents.document-liste'],

    ['id' => 'albums', 'label' => 'Albums','content'=>'',
    'component' => 'projet.albums.album-liste'],

      ['id' => 'indicateurs', 'label' => 'INDICATEUR', 'content'=>'',
       'component' => 'monitoring.indicateurs.indicateur-outil'],
    
     ['id' => 'decomptes', 'label' => 'decomptes', 'content'=>'', 'component' => 'projet.decomptes.decompte-liste'],

      ['id' => 'etudes', 'label' => 'Etudes', 'content'=>'', 'component' => 'etude.etudes.etude-liste'],
      
    
]" />  




</div>
