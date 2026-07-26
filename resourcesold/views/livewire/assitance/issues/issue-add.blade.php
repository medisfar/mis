<x-slot name="titre">Issues</x-slot>

              <x-slot name="stitre">@include('livewire.assitance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="User" fd="user_id" :options="\App\Models\User::tab()"></x-select>
<x-field nc="12" label="Title" fd="title"></x-field>
<x-field nc="12" label="Description" fd="description"></x-field>
<x-field nc="12" label="Priority" fd="priority"></x-field>
<x-field nc="12" label="Status" fd="status"></x-field>
<x-field nc="12" label="Resolved_at" fd="resolved_at"></x-field>
<x-field nc="12" label="Resolution_summary" fd="resolution_summary"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeIssue()">Enregistrer</button>

</div></div>