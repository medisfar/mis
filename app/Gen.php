<?php

namespace App;

class Gen
{
    public static function handle($mo,$t)
    {

        $tbl = $t->name;
        $mdl =ucfirst(substr($tbl,0,-1));
        
        $rt='';
        $cd =new Code;
        $rt.=($t->appli->path.'/resources/views/livewire/'.$tbl);
 
//dd($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/');
        if(!file_exists($t->appli->path.'/resources/views/livewire/'.$mo.'/'))
        mkdir($t->appli->path.'/resources/views/livewire/'.$mo.'/');

        if(!file_exists($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'))
        mkdir($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/');


        if(!file_exists($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/'))
        mkdir($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/');

        if(!file_exists($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'))
        mkdir($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/');

        if(!file_exists($t->appli->path.'/app/Traits/'))
        mkdir($t->appli->path.'/app/Traits/');

        if(!file_exists($t->appli->path.'/app/Traits/'.$mdl.'/'))
        mkdir($t->appli->path.'/app/Traits/'.$mdl.'/');


        //------------- component
        $cd->createFile($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Liste.php',$cd->cmp($mo,$t,'Liste'));
        $cd->createFile($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Add.php',$cd->cmp($mo,$t,'Add'));
        $cd->createFile($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Edit.php',$cd->cmp($mo,$t,'Edit'));
        $cd->createFile($t->appli->path.'/app/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Show.php',$cd->cmp($mo,$t,'Show'));

        //vues
        $cd->createFile($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-liste.blade.php',$cd->table($mo,$t, $mdl,'Liste'));

        $cd->createFile($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-add.blade.php',$cd->form($mo,$t,'Add'));
        $cd->createFile($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-edit.blade.php',$cd->form($mo,$t,'Edit'));
        $cd->createFile($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-show.blade.php',$cd->desc($mo,$t,'Show'));

        //------------- Trait/Model
        
        $cd->createFile($t->appli->path.'/app/Traits/'.$mdl.'Trait.php',
            $cd->trait($mo,$t, $mdl));

        $cd->createFile($t->appli->path.'/app/Models/'.$mdl.'.php',$cd->model($t));
        $cd->createMigration($t);

        //------------- Create
        
        $cd->createFile($t->appli->path.'/resources/views/livewire/'.$mo.'/'.$tbl.'/menu.blade.php','');
        $r="";
         $r.="\n  Route::prefix('$mo')->middleware('auth')->group(function(){";
         $r.="\n  Route::get('/$tbl',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Liste::class)->name('$mo.$tbl');";
         $r.="\n  Route::get('/$tbl/add',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Add::class)->name('$mo.$tbl.add');";
         $r.="\n  Route::get('/$tbl/{id}/edit',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Edit::class)->name('$mo.$tbl.edit');";
         $r.="\n  Route::get('/$tbl/{id}/show',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Show::class)->name('$mo.$tbl.show');";
         $r.="});\n\n";
         $cd->appendFile($t->appli->path.'/routes/web.php',$r);
         
        
    }
}
