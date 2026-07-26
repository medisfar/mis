<?php
namespace App\Livewire\Projet;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
use Livewire\WithPagination;
class IndicateursTabs extends Component {

use WithPagination;

       protected $paginationTheme = 'bootstrap';
       
       public function render() {
//dd('hhh');
	return view('livewire.projet.indicateurs-tabs');
}

}