<div class="row"> @php \App\Models\Resultat::repos(); @endphp
    <div class="col-md-3">
        <table>
           @foreach(\App\Models\Mission::all() as $index => $cmp)
                <tr>
                    <td>
                        <input type="checkbox" wire:model.live="t.{{$index}}">
                        <i class="bi bi-folder-fill text-primary me-2"></i>
                        

                        <span font-size="18pt" wire:click="handleViewUpdate('missions',{{ $cmp->id }},{{ $idp }})">
                            {{ $cmp->libelle }} 
                            <span class="badge bg-primary rounded-pill">1</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if(isset($t[$index]) && $t[$index]==true)
                            <table>
                                @foreach($cmp->resultats as $actIndex => $act)
                                    <tr>
                                        <td>
                                            <span wire:click="handleViewUpdate('resultat',{{ $act->id }},{{ $idp }})">
                                                &nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-folder text-info me-2"></i> 
                                                Resultat {{ $act->position }}
                                            </span>
                                            
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