<?php
namespace App\Livewire\Datacollect;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
use Livewire\WithPagination;
class BeneficiairesTabs extends Component {

use WithPagination;

       protected $paginationTheme = 'bootstrap';
       public function render() {

	return view('livewire.datacollect.beneficiaires-tabs');
}

}