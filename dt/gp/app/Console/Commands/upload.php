<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Image\Image;

class upload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $files = \Storage::disk('uploads')->files('photos');
        $this->info(count($files));
        foreach($files as $f){
           
           $ds=explode('.',$f);
           $rp=explode('/',$ds[0]);
           $fd=$rp[1];
           
           $this->info($f);
           $d= \App\Models\Personne::find($fd);
           if($d!=null){
               $this->info('saving '.$f);
               $d->photo=$f;
               $d->save();
               $pth=public_path('mesfics').'/'.$f;
               $this->info($f);
               $img=new Image('imagick');
               $img->load($pth)->height(50)->save(public_path('thumbs').'/'.$f);
               $img->load($pth)->height(600)->save(public_path().'/'.$f);
               unlink($pth);
               

           }
        }
    }
}
