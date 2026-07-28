<x-slot name="titre">Cadre résultats</x-slot>
<x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>

<div>
    <livewire:monitoring.indicateurs.indicateur-outil :lecture-seule="true" />
</div>
