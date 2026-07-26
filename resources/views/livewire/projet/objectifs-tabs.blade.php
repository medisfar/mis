<x-slot name="titre">Objectifs</x-slot>
<x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<x-mtabs :tabs="[
   
    ['id' => 'missions', 'label' => 'Missions','content'=>'', 'component' => 'projet.missions.mission-liste'],
     ['id' => 'odd', 'label' => 'Odds','content'=>'', 'component' => 'projet.odds.odd-liste'],
      ['id' => 'produits', 'label' => 'Produits','content'=>'', 'component' => 'projet.produits.produit-liste'],
       ['id' => 'resultats', 'label' => 'Resultats','content'=>'', 'component' => 'projet.resultats.resultat-liste'],
      
     
]" /> 
</div>
  
</div>