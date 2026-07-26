<div>
  
  <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
   @php 
   
   @endphp 
    <livewire:show-projet idm="{{session()->get('pid')}}" idp="{{session()->get('pid')}}" vue="projet"/>
</div>
