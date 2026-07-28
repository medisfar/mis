<?php

namespace App\Livewire;

use Livewire\Component;

class ChoisirProjet extends Component
{
    public $pid;

    public function mount(): void
    {
        $this->pid = session()->get('pid');
    }

    public function render()
    {
        $prs=\App\Models\Projet::orderBy('created_at','desc')->paginate(20);
        return view('livewire.choisir-projet',['prs'=>$prs]);
    }

    public function select($pid)
    {
        $redirectTo = request()->header('Referer') ?: route('dashboard');
        $pr = \App\Models\Projet::find($pid);

        if (! $pr) {
            $this->pid = null;
            session()->forget(['pid', 'projet']);

            return $this->redirect($redirectTo, navigate: false);
        }

        $this->pid = $pr->id;

        session()->put([
            'pid' => $pr->id,
            'projet' => [
                'libelle' => $pr->libelle,
                'nom_projet' => $pr->nom_projet,
            ],
        ]);

        return $this->redirect($redirectTo, navigate: false);
    }
}
