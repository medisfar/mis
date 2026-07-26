<x-slot name="titre">Sessions</x-slot>
<x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot><div>
    <x-mtabs :tabs="[
   ['id' => 'sessions', 'label' => 'Sessions','content'=>'', 'component' => 'datacollect.lessessions.lessession-liste'],
   ['id' => 'collectes', 'label' => 'collectes','content'=>'', 'component' => 'datacollect.collectes.collecte-liste'],
]" />

</div> 