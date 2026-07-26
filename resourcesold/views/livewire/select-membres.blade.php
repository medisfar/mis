 <x-slot name="titre">Session : {{$l->date_session}} / 
   {{$groupement->nom_groupe}} </x-slot>
<x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
 <div>
   <div class="row">

  <?php //$fields=$groupement->formulaire->properties();
$fields= \App\Models\Formulaire::find(5)->properties();
?>
    
<div class="col-md-2">
  <a class="btn btn-sm btn-success" style="pull-right" href="https://test.appsoor.org/gp/public/datacollect/sessions/tabs">Back</a>
  

      </div></div>

      <div class="table-responsive">
      <table  class="table table-bordered table-striped">
      <tr>
         
         <th>Nom</th>
         <th> 
         Date</th>
        
      <th></th></tr>
      <?php $ll=1; ?>
      @foreach($ms as $i=>$item)
      <?php set_time_limit(20); ?>
      <tr>
          <td>{{$ll++}}</td>
         <td>{{$item}}</td>
         
             <!-- <a href="/gp/public/form-saisie/session/{{$l->id}}/membres/{{$i}}/forms/{{$groupement->formulaire_id}}">saisir</a>-->
             
          <td>   
        <button class="btn btn-sm btn-success"
        wire:click="$dispatch('show-modal', { 
            title: 'Ajouter', 
            content: {
                type: 'component',
                name: 'form-preview',
                key: {{ rand(0,1000) }},
               params: {sid: {{ $l->id }}, mid: {{ $i }}, fid:{{$groupement->formulaire_id}}}
            }
        })">Saisir</button>

    </td>
        
      
      </tr>
      @endforeach
      </table></div>
      
          
      
</div>