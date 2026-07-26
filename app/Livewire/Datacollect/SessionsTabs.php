<?php
namespace App\Livewire\Datacollect;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
use Livewire\WithPagination;
class SessionsTabs extends Component {
public $gid,$sid;
use WithPagination;

       protected $paginationTheme = 'bootstrap';
       public function render() {

	return view('livewire.datacollect.sessions-tabs');
}

    #[On('groupement-changed')]
    public function handleGroupementSelected($ggid,$ssid){
     $this->sid=$ssid;
     $this->gid=$ggid;
    }
    
}