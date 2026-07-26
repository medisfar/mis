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
      <table  class="table table-bordered table-striped table-sm">
      <tr>
         <th>#</th>
         <th>Nom</th>
         
         @foreach($fields as  $k=>$v)
              <th width="100">{{$v}}</th>
        @endforeach</th>
        
      <th></th></tr>
      <?php $ll=1; ?>
      @foreach($ms as $i=>$item)
      <?php set_time_limit(20); 
      $rows=\App\Models\Metadonnee::whereRaw('lessession_id=? and membre_id=?',[$l->id,$i])->distinct()->count()??1; ?>
        <tr wire:key="row-{{ $i }}-{{ $l->id }}">
          <td>{{$ll++}} </td>
         <td >{{$item}}</td>
         
             
                 @php set_time_limit(30); @endphp
                 
                @php $r= \App\Models\Metadonnee::whereRaw('lessession_id=? and membre_id=?',[$l->id,$i])->first(); @endphp
               
                @if($r!==null)
                 @php $dt=json_decode($r->donnes,1)??[];   @endphp
                     @foreach($fields as $k=>$v)
                     <td width="100" style="text-align:centred"> {{$dt[$k]??''}}</td>
                     @endforeach
                   
              @else
              <td colspan="{{count($fields)}}"></td>
                  @endif
                 
             
             
             <!-- <a href="/gp/public/form-saisie/session/{{$l->id}}/membres/{{$i}}/forms/{{$groupement->formulaire_id}}">saisir</a>-->
             
          <td>   
       <button class="btn btn-sm btn-success"
        wire:click="$dispatch('show-modal', { 
            title: 'voir', 
            content: {
                type: 'component',
                name: 'form-preview',
                key: 'form-{{ $l->id }}-{{ $i }}-{{ $groupement->formulaire_id }}',
                params: {
                  
                     sid: {{ $l->id }}, 
                    mid: {{ $i }}, 
                    fid: {{ $groupement->formulaire_id ??5}}
                   
                }
            }
        })">saisir</button>
        
        <a href="{{route('ses',$i)}}">voit</a>
<button class="btn btn-sm btn-success"
        wire:click="$dispatch('show-modal', { 
            title: 'voir', 
            content: {
                type: 'component',
                name: 'sessions-enfant',
                key: 'form-{{ $l->id }}-{{ $i }}-{{ $groupement->formulaire_id }}',
                params: {
                  
                    mid: {{ $i }}, 
                   
                }
            }
        })">voir</button>
    </td>
        
      
      </tr>
      @endforeach
      </table></div>
      
          
      
</div>