@props(['mtitre','mid'])
<div>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$mid}}">
  {{$mtitre}}
</button>

    <div class="modal" tabindex="-1" id="{{$mid}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$mtitre}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$slot}}
      </div>
      <div class="modal-footer">
        <button type="button" wire:click="closeIt('{{$mid}}')" data-bs-dismiss="modal" class="btn btn-primary">Close</button>
        
      </div>
    </div>
  </div>
</div>
</div>