<div>
  
    Session : {{$l->date_session}} / Foyer {{$groupement->nom_groupe}} <br><br>
    
<?php //$fields=$groupement->formulaire->properties();
$fields= \App\Models\Formulaire::find(5)->properties();
?>
      <div class="table-responsive">
      <table  class="table table-bordered table-striped">
      <tr>
         
         <th>#</th>
         
         <th> 
         Nom</th>
         @foreach($fields as  $k=>$v)
              <td>{{$v}}</td>
        @endforeach
      <th></th></tr>
      @foreach($donnees as $i=>$item)
      <tr>
          <td>{{$i+1}} </td>
          <td>{{$item->membre->nom}} <br>{{$item->membre->groupement->first()->nom_groupe}}</td>
        <?php $arr=json_decode($item->donnes,1); ?>
         @foreach($fields as $k=>$v) 
 <td>{{$arr[$k]??$k}}</td>
        @endforeach
         <td>
        <button class="btn btn-sm btn-success"
        wire:click="$dispatch('show-modal', { 
            title: 'Ajouter', 
            content: {
                type: 'component',
                name: 'datacollect.collectes.show',
                key: {{ rand(0,1000) }},
                params: {id:{{$k}}}
            }
        })">Show</button>

    </td>
        
      
      </tr>
      @endforeach
      </table></div>
      
          
      
</div>