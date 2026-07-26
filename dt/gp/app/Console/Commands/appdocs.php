<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class appdocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path=public_path().'/mesfics';
        $dfiles = scandir($path);
        foreach($dfiles as $d){
            if(! in_array($d,['.','..','photos'])){
               $p=\App\Models\Personne::find($d);
               if($p!=null && is_dir(public_path().'/mesfics/'.$d)){
                  $files = scandir(public_path().'/mesfics/'.$d);
                  foreach($files as $f)
                  {
                    if(! in_array($f,['.','..'])){
                    $name=$d.'/'.$f;
                     $this->info($name.'---'.$p->noms);
                     if(!file_exists(public_path().'/uploads/'.$d))
                        mkdir(public_path().'/uploads/'.$d);
                    $nnm=public_path().'/uploads/'.$d.'/'.date('Y-m').$f;
                     rename($path.'/'.$name,$nnm);
                     $dc=new \App\Models\Document;
                     $dc->personne_id=$p->id;
                     $dc->titre=$nnm;
                     $dc->fichier=$f;
                     $dc->doc_date=date('Y-m-d');
                     $dc->save();
                    }
                  }
                  rmdir(public_path().'/mesfics/'.$d);
        
               }
           }
            
        }
    }
}
