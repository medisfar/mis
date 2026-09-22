<x-slot name="titre">Programmes</x-slot>

<div>
<x-mtabs :tabs="[
   
    ['id' => 'bailleurs', 'label' => 'Bailleurs','content'=>'', 'component' => 'projet.bailleurs.bailleur-liste'],
    ['id' => 'projets', 'label' => 'Projets','content'=>'', 'component' => 'projet.projets.projet-liste'],
     
    ['id' => 'composantes', 'label' => 'Composantes', 'content' =>'', 'component'=> 'projet.composantes.composante-liste'],
     
   
    ['id' => 'sscomposantes', 'label' => 'Sous Composantes', 'content'=>'', 'component' => 'projet.souscomposantes.souscomposante-liste'],
     

    ['id' => 'activites', 'label' => 'Activites', 'content'=>'', 'component' => 'projet.activites.activite-liste'],
     ['id' => 'taches', 'label' => 'Sous-activités', 'content'=>'', 'component' => 'projet.taches.tache-liste'],
    // ['id' => 'sites', 'label' => 'Sites', 'content'=>'', 'component' => 'projet.sites.site-liste'],
]" /> 
</div>
