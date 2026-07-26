<?php

namespace App\Livewire;

use Livewire\Component;

class FormSaisie extends Component
{
     public $mid;
    public $ses_id;
    public $fid;
    public function mount($ses_id,$mid,$fid){
        $this->mid=$mid;
        $this->ses_id=$ses_id;
        $this->fid=$fid;
       
    }
    public function render()
    {
        $m=\App\Models\Membre::find($this->mid);
        return view('livewire.form-saisie',['membre'=>$m,'ses_id'=>$this->ses_id]);
    }
    public function add(){
       // dd([$this->sid,$this->ses_id]);
        return redirect()->route('form.saisie',['mid'=>$this->mid,'ses_id'=>$this->ses_id]);
    
    }
}