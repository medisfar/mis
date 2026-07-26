<x-slot name="titre">Sessions</x-slot>
<x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot><div>
    @php set_time_limit(300); @endphp
    <x-mtabs :tabs="[
  ['id' => 'groupes', 'label' => 'Groupement','content'=>'',
    'component' => 'beneficiaire.groupements.groupement-listeb'],
   ['id' => 'sessions', 'label' => 'Sessions','content'=>'', 'component' => 'datacollect.lessessions.lessession-liste'],
   ['id' => 'Importation', 'label' => 'Importation','content'=>'', 'component' => 'importation'],
]" />

</div> 