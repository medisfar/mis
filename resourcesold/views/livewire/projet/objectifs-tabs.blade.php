<x-slot name="titre">Objectifs</x-slot>

<div>
<x-mtabs :tabs="[
   
    ['id' => 'missions', 'label' => 'Missions','content'=>'', 'component' => 'projet.missions.mission-liste'],
     ['id' => 'secteurs', 'label' => 'Secteurs','content'=>'', 'component' => 'projet.secteurs.secteur-liste'],
      ['id' => 'produits', 'label' => 'Produits','content'=>'', 'component' => 'projet.produits.produit-liste'],
       ['id' => 'resultats', 'label' => 'Resultats','content'=>'', 'component' => 'projet.resultats.resultat-liste'],
      
     
]" /> 
</div>
  
</div>