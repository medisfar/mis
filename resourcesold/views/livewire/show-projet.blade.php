<div class="row">
    <div class="col-md-3">
        <table>
            @foreach(\App\Models\Composante::where('projet_id',$idp)->get() as $index => $cmp)
                <tr>
                    <td>
                        <input type="checkbox" wire:model.live="t.{{$index}}">
                        <i class="bi bi-folder-fill text-primary me-2"></i>
                        

                        <span font-size="18pt" wire:click="handleViewUpdate('composante',{{ $cmp->id }},{{ $idp }})">
                            {{ $cmp->code }} 
                            <span class="badge bg-primary rounded-pill">{{ $cmp->activites->count() }}</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if(isset($t[$index]) && $t[$index]==true)
                            <table>
                                @foreach($cmp->activites as $actIndex => $act)
                                    <tr>
                                        <td>
                                            <span wire:click="handleViewUpdate('activite',{{ $act->id }},{{ $idp }})">
                                                &nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-folder text-info me-2"></i> 
                                                Activite {{ $actIndex + 1 }}
                                            </span>
                                            <span class="badge bg-success rounded-pill">{{ $act->sites->count() }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-9">
        @include('livewire.partials.'.$vue,['idm'=>$idm,'idp'=>$idp])
    </div>
</div>