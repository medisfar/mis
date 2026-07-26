<div class="col-md-3">
    <table>
        @foreach(\App\Models\Composante::where('projet_id',9)->get() as $cmp)
        <tr>
            <td><i class="bi bi-folder-fill text-primary me-2"></i> {{ $cmp->code }} <a href="#" 
    wire:click="handleViewUpdate('composante',$cmp->id,$idp) }}','idp':9})"
    class="fw-semibold cursor-pointer">voir
    
</a></td>
          </tr>  
          @endforeach
      </table>
  </div>
  <div class="col-md-9">    
 <x-slot name="content-data">
</div>