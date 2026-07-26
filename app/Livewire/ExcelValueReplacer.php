<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExcelValueReplacer extends Component
{
    use WithFileUploads;

    public $file;
    public $columns = [];
    public $selectedColumn;
    public $uniqueValues = [];
    public $selectedValue;
    public $uploadId;
    public $isProcessed = false;
    public $downloadLink;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
    ];

    public function render()
    {
        return view('livewire.excel-value-replacer');
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
        $this->resetProcess();
    }

    public function processFile()
    {
        $this->validate();
$name=\Str::random(6).'_'.$this->file->getClientOriginalName();
        // Store the file
        $storedPath = $this->file->storeAs('excel-uploads',$name);

        // Save file info to database with "not treated" status
        $upload = UploadedFile::create([
            'original_name' => $name,
            'stored_path' => $storedPath,
            'status' => 'not treated',
            'uuid' => Str::uuid(),
        ]);
        // load
        $data=[];
        
if (($handle = fopen(public_path().'/files/'.$storedPath, "r")) !== FALSE) {
    while (($ds = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $data[]=$ds;
    }
    fclose($handle);
}

        $this->uploadId = $upload->id;

        // Get the first sheet data to extract columns
        $data =[] ;
        
        if (count($data) > 0) {
            $this->columns = array_keys($data[0]);
        }
    }

    public function loadColumnValues()
    {
        if (!$this->selectedColumn) return;

        $values = array_column($data, $this->selectedColumn);
        $this->uniqueValues = array_unique(array_filter($values));
        sort($this->uniqueValues);
    }

    public function replaceValues()
    {
        if (!$this->selectedValue) {
            $this->addError('selectedValue', 'Please select a value to replace with');
            return;
        }

      
        foreach ($data as &$row) {
            $row[$this->selectedColumn] = $this->selectedValue;
        }

        // Save the modified file
        $newFileName = 'modified_' . $upload->original_name;
        $newPath = 'excel-uploads/' . $newFileName;
        
       $outFile = fopen($newPath, "w") or die("Unable to open file!");
foreach ($data as $row) {
    fputcsv($outFile, $row);
}
fclose($outFile);

        $this->downloadLink = Storage::url($newPath);
        $this->isProcessed = true;
    }

    private function resetProcess()
    {
        $this->reset([
            'columns',
            'selectedColumn',
            'uniqueValues',
            'selectedValue',
            'uploadId',
            'isProcessed',
            'downloadLink',
        ]);
    }
}