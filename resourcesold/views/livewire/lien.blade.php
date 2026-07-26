<div>
    <input wire:model="lien"><button wire:click="add">Add</button>
    <table class="table">
    @foreach($ls as $l)
    <tr>
    <td><a href="{{$l->liendoc}}">{{$l->liendoc}}<a></a></a></td>
    </tr>
    </tr>
    @endforeach
    </table>
</div>