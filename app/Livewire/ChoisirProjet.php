<?php

namespace App\Livewire;

use Livewire\Component;

class ChoisirProjet extends Component
{
    public $pid;
    public function render()
    {
        $prs=\App\Models\Projet::orderBy('created_at','desc')->paginate(20);
        return view('livewire.choisir-projet',['prs'=>$prs]);
    }
    public function select(){
       $pr=\App\Models\Projet::find($this->pid);
       session()->put('pid',$this->pid);
       session()->put('projet', [
    'libelle' => $pr->libelle,
    'nom_projet' => $pr->nom_projet
]);
     //  return redirect()->route('dashboard'); 
      return redirect(request()->header('Referer')); 
    }
}
