<?php

namespace App\Livewire;

use Livewire\Component;

class ChoixMembre extends Component
{
    public $sid;
    public $ses_id;
    public function mount($id){
        $this->sid=$id;
        //$this->ses_id=$ses_id;
    }
    public function render()
    {
        $site=\App\Models\Site::find($this->sid);
        //dd(\App\Models\Groupement::all());dd(\App\Models\Groupement::all());
        $g=\App\Models\Groupement::where('site_id',$this->sid)->first();//->membres;
        $membres=\DB::select('select m.id, m.nom from membres m,groupement_membre g where m.id=g.membre_id and g.groupement_id='.$g->id);
        return view('livewire.choix-membre',['site'=>$site,'membres'=>$membres]);
    }
    public function add(){
       // dd([$this->sid,$this->ses_id]);
        return redirect()->route('form.saisie',['mid'=>$this->sid,'fid'=>$this->ses_id]);
    
    }
}
