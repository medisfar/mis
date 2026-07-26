<x-slot name="titre">Ptpa</x-slot>
<x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot><div>
   <livewire:show-projet idm="{{session()->get('pid')}}" idp="{{session()->get('pid')}}" vue="projet"/>
</div> 