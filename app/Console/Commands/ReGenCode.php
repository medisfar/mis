<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\ReCode;
class ReGenCode extends Command
{
    /**
     * The name and signature of the console command     *
     * @var string
     */
    protected $signature = 'regencode {mo} {cvr} {tbl} {mdl}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cvr=$this->argument('cvr');
        $tbl = $this->argument('tbl');
        $mdl = $this->argument('mdl');
        $mo=$this->argument('mo');
        //print('c='.$cvr.' mo='.$mo.' tbl='.$tbl.' mdl='.$mdl);
        //exit;
        $cd =new ReCode;
        $this->info(app_path().'/../resources/views/livewire/'.$tbl);

        if(!file_exists(app_path().'/../resources/views/livewire/'.$mo.'/'))
        mkdir(app_path().'/../resources/views/livewire/'.$mo.'/');

        if(!file_exists(app_path().'/Livewire/'.ucfirst($mo).'/'))
        mkdir(app_path().'/Livewire/'.ucfirst($mo).'/');

        if(!file_exists(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/'))
        mkdir(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/');

        if(!file_exists(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'))
        mkdir(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/');

        if(!file_exists(app_path().'/Traits/'))
        mkdir(app_path().'/Traits/');

        if(!file_exists(app_path().'/Traits/'))
        mkdir(app_path().'/Traits/'.$mdl.'/');


        //------------- component
        $cd->createFile(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Liste.php',$cd->cmp($cvr,$mo,$tbl, $mdl,'Liste'));
        $cd->createFile(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Add.php',$cd->cmp($cvr,$mo,$tbl, $mdl,'Add'));
        $cd->createFile(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Edit.php',$cd->cmp($cvr,$mo,$tbl, $mdl,'Edit'));
        $cd->createFile(app_path().'/Livewire/'.ucfirst($mo).'/'.ucfirst($tbl).'/'.$mdl.'Show.php',$cd->cmp($cvr,$mo,$tbl, $mdl,'Show'));

        //vues
        $cd->createFile(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-liste.blade.php',$cd->table($cvr,$mo,$tbl, $mdl,'Liste'));
        $cd->createFile(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-add.blade.php',$cd->form($cvr,$mo,$tbl, $mdl,'Add'));
        $cd->createFile(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-edit.blade.php',$cd->form($cvr,$mo,$tbl, $mdl,'Edit'));
        $cd->createFile(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/'.strtolower($mdl).'-show.blade.php',$cd->desc($cvr,$mo,$tbl, $mdl,'Show'));

        //------------- Trait/Model
        
        $cd->createFile(app_path().'/Traits/'.$mdl.'Trait.php',
            $cd->trait($cvr,$mo,$tbl, $mdl));

        $cd->createFile(app_path().'/Models/'.$mdl.'.php',
            $cd->model($tbl, $mdl));

        //------------- Create
        
        $cd->createFile(app_path().'/../resources/views/livewire/'.$mo.'/'.$tbl.'/menu.blade.php','');
        $r="";
         $r.="Route::prefix('$cvr')->middleware('auth')->group(function(){";
         $r.="Route::get('/$mo/$tbl',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Liste::class)->name('$cvr.$mo.$tbl');";
         $r.="Route::get('/$mo/$tbl/add',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Add::class)->name('$cvr.$mo.$tbl.add');";
         $r.="Route::get('/$mo/{ide}/$tbl/{id}/edit',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Edit::class)->name('$cvr.$mo.$tbl.edit');";
         $r.="Route::get('/$mo/{ide}/$tbl/{id}/show',App\Livewire\\".ucfirst($mo)."\\".ucfirst($tbl)."\\".$mdl."Show::class)->name('$cvr.$mo.$tbl.show');";
         $r.="});\n\n";
         $cd->appendFile(app_path().'/../routes/web.php',$r);
         $this->info("Termine!");
        return Command::SUCCESS;
    }
}
