<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Region;
use App\Models\Prefecture;
use App\Models\Ssprefecture;
use App\Models\Localite;

class LocaliteSelector extends Component
{
    public $region_id;
    public $prefecture_id;
    public $ssprefecture_id;
    public $model;
    public function mount($init=null){
      if($init !=null){
        $this->model=$init;
        $loc=\App\Models\Localite::find($this->model);
        if($loc!=null){
        $sp=$loc->ssprefecture;
        $p=$sp->prefecture;
        $this->ssprefecture_id=$sp->id;
        $this->prefecture_id=$sp->prefecture_id;
        $this->region_id=$p->region_id;
        //dd([$loc,$this->model,$this->ssprefecture_id,$this->prefecture_id,$this->region_id]);
    }
      }
    }
    public function render()
    {
        $data=[
            'regions' => Region::all()->pluck('nom_region', 'id'),
            'prefectures' => $this->region_id 
                ? Prefecture::where('region_id', $this->region_id)->pluck('nom_prefecture', 'id') 
                : [],
            'ssprefectures' => $this->prefecture_id 
                ? Ssprefecture::where('prefecture_id', $this->prefecture_id)->pluck('nom_ssprefecture', 'id') 
                : [],

            'localites' => $this->prefecture_id 
                ? Localite::where('ssprefecture_id', $this->ssprefecture_id)->pluck('nom_localite', 'id') 
                : []];
        
        return view('livewire.localite-selector', $data);
    }
    
    public function updatedRegionId()
    {
        $this->reset(['prefecture_id', 'ssprefecture_id','model']);
    }
    
    public function updatedPrefectureId()
    {
        $this->reset(['ssprefecture_id','model']);
    }

    public function updatedSsprefectureId()
    {
        $this->reset('model');
    }

}