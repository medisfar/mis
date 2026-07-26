<?php
namespace App\Livewire;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
use Livewire\WithPagination;
class DatacollectSessions extends Component {

use WithPagination;

       protected $paginationTheme = 'bootstrap';
       public function render() {

	return view('livewire.datacollect.sessions');
}

}