<div>
  
    Session : {{$l->date_session}} / Foyer {{$groupement->nom_groupe}} <br><br>
    
<?php //$fields=$groupement->formulaire->properties();
$fields= \App\Models\Formulaire::find(5)->properties();
?>
      <div class="table-responsive">
      <table  class="table table-bordered table-striped table-sm" style ="text-align:center">
      <tr>
         
         <th>No</th>
         
         <th width="30%" style="white-space: nowrap;overflow-x: auto; width: 100%;"> 
         Nom</th>
         @foreach($fields as  $k=>$v)
              <th>{{$v}}</th>
        @endforeach
      <th></th></tr>
      @foreach($donnees as $i=>$item)
      <tr>
          <td>{{$i+1}} </td>
          <td>{{$item->membre->nom}} </td>
        <?php $arr=json_decode($item->donnes,1); ?>
         @foreach($fields as $k=>$v) 
 <td>{{$arr[$k]??$k}}</td>
        @endforeach
         <td>
        

    </td>
        
      
      </tr>
      @endforeach
      </table></div>
      
          
      
</div>