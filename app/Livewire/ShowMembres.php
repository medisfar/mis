<?php

namespace App\Livewire;

use Livewire\Component;

class ShowMembres extends Component
{ 
    public $fid=0,$mid=0,$gid,$sid;
    public function mount($sid,$gid){
        $this->gid=$gid;
        $this->sid=$sid;

    } 
    #On["selectupdate"]
    public function handle(){
        $this->render();
    }
    
    
    public function render()
    {  $l=\App\Models\Lessession::find($this->sid);
        $d=\App\Models\MetaDonnee::where('lessession_id',$this->sid)->get();
     //  dd($d);
     //   dd(json_decode(\App\Models\MetaDonnee::first()->donnes,1));
        $grs=\App\Models\Groupement::find($this->gid)->membres; 
        $ms=[];
        foreach($grs as $m)
            $ms[$m->id]=$m->nom;
           // dd(\App\Models\Groupement::find($this->gid));
        return view('livewire.show-membres',['ms'=>$ms,'l'=>$l,'donnees'=>$d,'groupement'=>\App\Models\Groupement::find($this->gid)]);
    }
       
}
