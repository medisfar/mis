<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CsvImporter extends Component
{
    public $dts=[];
    public function mount($modelClass, $validationRules = [], $chunkSize = 1000)
    {
        $this->modelClass = $modelClass;
        $this->validationRules = $validationRules;
        $this->chunkSize = $chunkSize;
    }

    public function render()
    {
        return view('livewire.csv-importer');
    }

    public function import()
    {
        
        $this->readSampleData();
    }

    private function readSampleData()
    {
        
$row = 1;$dt=[];
$keys=[
'id'=>14,
'chef'=>15,
'loc'=>7,
'conjoint'=>75,
'long'=>9,
'lat'=>10,
'tel'=>18,
];
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
      //  dd($data);
     $d=[];
     foreach($keys as $f=>$k){
       $d[$f]=$data[$k]??'';
     }
     $dt[]=$d;
       /* 
        if($data[2]!='')
        $b= new \App\Models\Menage;
        $b->id=$data[2];
        $b->chef=$data[3];
        
        $b->save();
     */
    }
}
$this->dts=$dt;
}}