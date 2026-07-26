<?php
namespace App\Livewire;
use Livewire\Component;
use \App\Traits\ProjetTrait;
use \App\Models\Projet;
use Livewire\WithPagination;
class Parametrage extends Component {

use WithPagination;

       protected $paginationTheme = 'bootstrap';
public function render() {
	
	return view('livewire.projet.index');
}

}