<x-app-layout><x-slot name="titre">Programmes</x-slot>

<div>
<x-mtabs :tabs="[
   
    ['id' => 'docs', 'label' => 'Documents','content'=>'', 'component' => 'reporting.documents.document-liste'],

     ['id' => 'albums', 'label' => 'Albums','content'=>'', 'component' => 'reporting.albums.album-liste'],

    
     
     

   
]" /> 
</div></x-app-layout>