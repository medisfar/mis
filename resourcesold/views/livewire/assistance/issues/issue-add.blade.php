<x-slot name="titre">Issues</x-slot>

              <x-slot name="stitre">@include('livewire.assistance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Title" fd="title"></x-field>
<x-mtextarea nc="12" label="Description" fd="description"></x-mtextarea>
<x-select nc="3" label="Priority" fd="priority"
:options="\App\Models\Issue::priorities()"></x-select>
<x-select nc="3" label="Status" fd="status"
:options="\App\Models\Issue::statuses()"></x-select>
<x-file nc="6" label="Image_before" fd="image_before"></x-file></div>
<button class="btn btn-sm btn-success"  wire:click="storeIssue()">Enregistrer</button>

</div>