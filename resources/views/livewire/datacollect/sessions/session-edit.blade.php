<x-slot name="titre">Sessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="User" fd="user_id" :options="\App\Models\User::tab()"></x-select>
<x-field nc="12" label="Ip_address" fd="ip_address"></x-field>
<x-field nc="12" label="User_agent" fd="user_agent"></x-field>
<x-field nc="12" label="Payload" fd="payload"></x-field>
<x-field nc="12" label="Last_activity" fd="last_activity"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateSession()">Enregistrer</button>

</div></div>