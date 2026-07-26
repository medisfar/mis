<x-app-layout>
    
   <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
           <div>
 <livewire:show-projet idm="1" idp="{{session()->get('pid')}}" vue="composante"/>


        </div>
    </div>
</x-app-layout>
