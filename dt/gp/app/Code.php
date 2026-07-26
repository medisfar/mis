<?php

namespace App;

class Code
{
    public function cmp($mo, $tbl, $mdl, $ext)
    {
        $tblc = ucfirst($tbl);
        if ($mdl == '') {
            if (\Str::contains($tbl, '_')) {
                $mdl = substr($tbl, 0, strlen($tbl) - 1);
                $ps = explode('_', $mdl);
                $mdl = '';
                foreach ($ps as $p) {
                    $mdl .= ucfirst($p);
                }
            } else {
                $mdl = ucfirst(substr($tbl, 0, strlen($tbl) - 1));
            }
        }
        $lmdl = 'un'.strtolower($mdl);
        $lmdlv = strtolower($mdl);
        $lmdls = $lmdl.'s';

        $st = '';
        $allfields = \Schema::getColumnListing($tbl);
        $fields = [];
        foreach ($allfields as $k => $v) {
            $fields[$v] = $v;
        }

        $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);
        // -------------- Variables --------------------
        $st = '<?php'."\n";
        $st .= 'namespace App\\Livewire\\'.ucfirst($mo).'\\'."$tblc;\n";
        $st .= 'use Livewire\\Component;'."\n";

        $st .= 'use \\App\\Traits\\'.$mdl.'Trait;'."\n";
        $st .= 'use \\App\\Models\\'.$mdl.';'."\n";
        if (in_array($ext, ['Liste'])) {
            $st .= 'use Livewire\\WithPagination;'."\n";
        }

        $st .= "class {$mdl}{$ext} extends Component {\n";
        $st .= "use {$mdl}Trait;\n";
        if (in_array($ext, ['Liste'])) {
            $st .= "use WithPagination;\n
       protected \$paginationTheme = 'bootstrap';";
        }
        // ------------------ Cmp edit listen ----------------
        /*if (in_array($ext, ['Edit'])) {
            $st .= "public \$listeners=['{$mdl}Selected'];\n";
            $st .= "public function {$mdl}Selected(\$ids) {\n";
            $st .= "\t\$this->sid=\$ids;\n";

            $st .= "\t\$this->edit{$mdl}(\$ids);\n";
            $st .= "}\n";
        }*/

        // ------------------ Cmp fire setsel ----------------
       /** if (in_array($ext, ['Cmp'])) {
            $st .= "public \$listeners=['{$mdl}Updated'=>'\$refresh'];\n";
            $st .= "public function setsel(\$ids) {\n";
            $st .= "\t\$this->emit('{$mdl}Selected',\$ids);\n";

            $st .= "}\n";
        }
        */
        // ------------------ mount ----------------
        if (in_array($ext, ['Edit', 'Show'])) {
            $st .= "public function mount(\$id) {\n";
            $st .= "\t\$this->sid=\$id;\n";
            if ($ext == 'Edit' || $ext == 'Show') {
                $st .= "\t\$this->edit$mdl(\$this->sid);";
            }
            $st .= "}\n";
        }

        // -------------- function render --------------
        $st .= "public function render() {\n";
        $st .= "\t\$qr=\\App\\Models\\$mdl::query();\n";
         if (in_array($ext, ['Liste'])) {
           $st .= "\tif(\$this->search!==null) \n\t";
           $alf=array_values($fields);
         $st .= "\$qr=\\App\\Models\\$mdl::where('".($alf[0]??'')."',\$this->search);\n";
         }
        $st .= "\t\$this->$tbl=\$qr->paginate(20);\n";
        $st .= "\tif(\$this->sid!==null) \n\t\$this->$lmdl=\\App\\Models\\$mdl::find(\$this->sid);\n";

        if ($ext == 'Add') {
            $st .= "\t\$this->create$mdl(\$this->sid);";
        }

        $st .= "\treturn view('livewire.$mo.$tbl.$lmdlv".'-'.strtolower($ext)."',\n";
        $st .= "\t   ['$tbl'=>\$this->$tbl,'$lmdlv'=>\$this->$lmdl]);\n}\n\n";

        //------------- function reset -----------------
        $st .= "public function reset$mdl() {\n";
        foreach ($fields as $f) {
            $st .= "\t \$this->$f  = '';\n";
        }

        $st .= "}\n}";

        return $st;
    }

    public function model($tbl, $mdl = '')
    {
        if ($mdl == '') {
            if (\Str::contains($tbl, '_')) {
                $mdl = substr($tbl, 0, strlen($tbl) - 1);
                $ps = explode('_', $mdl);
                $mdl = '';
                foreach ($ps as $p) {
                    $mdl .= ucfirst($p);
                }
            } else {
                $mdl = ucfirst(substr($tbl, 0, strlen($tbl) - 1));
            }
        }
        $lmdl = 'un'.strtolower($mdl);
        $lmdls = $lmdl.'s';

        $st = '';
        $allfields = \Schema::getColumnListing($tbl);
        $fields = [];
        foreach ($allfields as $k => $v) {
            $fields[$v] = $v;
        }

        $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);
        // -------------- Variables --------------
        $st = '<?php'."\n";
        $st .= "namespace App\Models;\n";
        
        $st .= "use Illuminate\Database\Eloquent\Factories\HasFactory;\n";
        $st .= "use Illuminate\Database\Eloquent\Model;\n";

        $st .= "class $mdl extends Model\n";
        $st .= "{\n";
       
        
        $st .= "\tpublic \$guarded=['id'];\n\n";
        $ff = current($fields);
        $st .= "\tpublic static function tab(){\n";
        $st .= "\treturn $mdl::pluck('$ff','id')->prepend('','');\n";
        $st .= "}\n";

        foreach ($fields as $fl) {
            if (\Str::endsWith($fl, '_id')) {
                $nf = str_replace('_id', '', $fl);
                $pts = explode('_', $nf);
                $nfm = '';
                foreach ($pts as $p) {
                    $nfm .= ucfirst($p);
                }

                $nfml = strtolower($nfm[0]).substr($nfm, 1, strlen($nfm));
                $st .= "public function $nfml() {\n";
                $st .= "\t return \$this->belongsTo('\\App\\Models\\$nfm');\n";
                $st .= "    }\n\n";
            }
        }

        $xt = $this->invrels($tbl, $mdl);
        foreach ($xt as $xf) {
            $xlf=ucfirst(substr($xf,0,-1));
            $st .= "public function $xf() {\n";
            $st .= "\t return \$this->hasMany('\\App\\Models\\$xlf');\n";
            $st .= "    }\n\n";
        }

        $st .= "}\n";

        return $st;
    }

    public function trait($mo, $tbl, $mdl = '')
    {
        if ($mdl == '') {
            if (\Str::contains($tbl, '_')) {
                $mdl = substr($tbl, 0, strlen($tbl) - 1);
                $ps = explode('_', $mdl);
                $mdl = '';
                foreach ($ps as $p) {
                    $mdl .= ucfirst($p);
                }
            } else {
                $mdl = ucfirst(substr($tbl, 0, strlen($tbl) - 1));
            }
        }
        $lmdl = 'un'.strtolower($mdl);
        $lmdlv = strtolower($mdl);
        $lmdls = $lmdl.'s';

        $st = '';
        $allfields = \Schema::getColumnListing($tbl);
        $fields = [];
        $rqr = [];
        $rows=\DB::select('SHOW COLUMNS FROM '.$tbl);
        foreach($rows as $r)
            if(!in_array($r->Field, ['id', 'created_at', 'updated_at', 'deleted_at']))
            {
                $fields[]=$r->Field;
                $rqr[$r->Field]=$r->Null;
            }

        $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);
        // -------------- Variables --------------
        $st = '<?php'."\n";
        $st .= "namespace App\\Traits;\n";

        $st .= 'use Livewire\Component;'."\n";
        $st .= 'use \\App\\Models\\'.$mdl.';'."\n";
        $st .= "Trait {$mdl}Trait {\n";
        $st .= "  protected \$$tbl,\$$lmdl;\n";
        $st .= "  public  \$sid,\$state='home',\$search;\n";
        $st .= '  public ';
        $i = 0;

        foreach ($fields as $k => $v) {
            if ($i == count($fields) - 1) {
                $st .= "\$$v;";
            } else {
                $st .= "\$$v,";
            }

            $i++;
        }

        $st .= "\n\n";
        /**
        // -------------- function render --------------
        $st .= "public function render() {\n";
        $st .= "\t\$qr=\\App\\Models\\$mdl::query();\n";
        $st .= "\t\$this->$lmdls=\$qr->paginate(20);\n";
        $st .= "\tif(\$this->sid!==null) \n\t\$this->$lmdl=\\App\\Models\\$mdl::find(\$this->sid);\n";
        $st .= "\treturn view('livewire.$tbl.'.\$this->state,\n";
        $st .= "\t   ['$lmdls'=>\$this->$lmdls,'$lmdl'=>\$this->$lmdl]);\n}\n\n";
         */
        //------------- function reset -----------------
        $st .= "public function reset$mdl() {\n";
        foreach ($fields as $f) {
            $st .= "\t \$this->$f  = '';\n";
        }

        $st .= "}\n\n";
        //------------- function cancel -----------------
        $st .= "public function cancel$mdl() {\n";
        $st .= "\t \$this->state       = 'home';\n";

        $st .= "}\n\n";
        //------------- function create -----------------
        $st .= "public function create$mdl() {\n";

        $st .= "\t \$this->state       = 'create';\n";
        $st .= " \t\$this->sid = null;\n";
        $st .= "\t\$this->$lmdl = new $mdl;\n}\n\n";

        //------------- function store -----------------
        $st .= "public function store$mdl() {\n";

        $st .= "\t\$this->validate([\n";
        foreach ($fields as $f) {
            if($rqr[$f]=='No') $cm='//'; else $cm='';
            $st .= " \t'$f'    => ".$cm."'required', \n";
        }

        $st .= "\t]);\n";
        $st .= "\t\$$lmdl = new $mdl;\n";
        $st .= "\t\${$lmdl}->create([\n";
        foreach ($fields as $f) {
            $st .= " \t'$f'    => \$this->$f, \n";
        }

        $st .= "\t]);\n";
        $st .= "\t\$this->reset$mdl();\n";

        $st .= "\t return redirect()->route('$mo.$tbl');\n}\n\n";
        //------------- function show -----------------
        $st .= "public function show$mdl(\$id) {\n";

        $st .= "\t \$this->state       = 'show';\n";
        $st .= " \t\$this->sid = \$id;\n";
        $st .= "\t\$this->$lmdl =  $mdl::find(\$id);\n";
        foreach ($fields as $f) {
            $st .= " \t\$this->$f    = \$this->$lmdl->$f; \n";
        }

        $st .= "}\n\n";
        //------------- function edit -----------------
        $st .= "public function edit$mdl(\$id) {\n";

        $st .= "\t \$this->state       = 'edit';\n";
        $st .= " \t\$this->sid = \$id;\n";
        $st .= "\t\$this->$lmdl =  $mdl::find(\$id);\n";
        $st .= "if(\$this->$lmdl != null) {\n";
        foreach ($fields as $f) {
            $st .= " \t\$this->$f    = \$this->$lmdl->$f; \n";
        }

        $st .= "}}\n\n";
        //------------- function update -----------------
        $st .= "public function update$mdl() {\n";

        $st .= "\t\$this->validate([\n";
        foreach ($fields as $f) {
            
            if($rqr[$f]=='No') $cm='//'; else $cm='';
            $st .= " \t'$f'    => ".$cm."'required', \n";
        }

        $st .= "\t]);\n";
        $st .= "\tif (\$this->sid) {\n";
        $st .= "   \$$lmdl = $mdl::find(\$this->sid);\n";
        $st .= "\t\${$lmdl}->update([\n";
        foreach ($fields as $f) {
            $st .= " \t'$f'    => \$this->$f, \n";
        }

        $st .= "\t]);\n";

        $st .= "\t\$this->reset$mdl();\n";

        $st .= "\t return redirect()->route('$mo.$tbl');\n\n";

        $st .= "}}\n\n";

        //--------- function destroy ------------
        $st .= "public function destroy$mdl(\$id)\n{\n";

        $st .= " if (\$id) {\n";
        $st .= "  \t   \$$lmdl = $mdl::find( \$id);\n";
        $st .= "   \t \${$lmdl}->delete();\n\t}\n\n\n";
$st .= "\t return redirect()->route('$mo.$tbl');\n}\n\n";
        $st .= "}\n";

        return $st;
    }

    public function form($mo, $tbl, $mdl, $ext)
    {
        $fm = $ext == 'Edit' ? 'modaledit' : 'modal';
        $st = '';
        
        $allfields = \Schema::getColumnListing($tbl);

        $fields=[];
        $rows=\DB::select('SHOW COLUMNS FROM '.$tbl);
        foreach($rows as $r)
            if(!in_array($r->Field, ['id', 'created_at', 'updated_at', 'deleted_at']))
            $fields[]=$r->Field;

       

        $lbl = ['Add' => 'Ajouter', 'Edit' => 'Modifier'];

        //$fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);

        $mt = $ext == 'Add' ? 'store' : 'update';
        $css = $ext == 'Add' ? 'success' : 'danger';

        $st .= "<x-slot name=\"titre\">{$mdl}s</x-slot>\n
              <x-slot name=\"stitre\">@include('livewire.$mo.menu')</x-slot>\n<div>\n";
        $st .= "\n@include('livewire.errors')\n";
        $st .= "<div class=\"row\">\n";
        foreach ($fields as $f) {
            
            if (\Str::endsWith($f, '_id')) {
                
               $rf = \App\Uts::camel(str_replace('_id', '', $f));
                $st .= '<x-select nc="12" label="'.\App\Uts::label($f)."\" fd=\"$f\" :options=\"\App\Models\\".$rf."::tab()\"></x-select>\n"; 
            }     
            else{ 
                if(\Str::startsWith($f, 'l_'))
                {
                
                $rf = str_replace('l_', '', $f);
                $rfs="::{$rf}s()";
                $st .= '<x-select nc="12" label="'.\App\Uts::label($rf).
                "\" fd=\"$f\" :options=\"\App\Models\\".$mdl.$rfs."\"></x-select>\n";
            } else{
                $st .= '<x-field nc="12" label="'.\App\Uts::label($f)."\" fd=\"$f\"></x-field>\n";
            }}}
        
        $lmdl = strtolower($mdl);
        $st .= "<button class=\"btn btn-sm btn-$css\"  wire:click=\"$mt$mdl()\">Enregistrer</button>\n";
        $st .= "\n</div></div>";

        return $st;
    
}

    public function table($mo, $tbl, $mdl, $ext)
    {
        // $mdl       = ucfirst(substr($tbl, 0, strlen($tbl) - 1));
        $st = '';
         $fields=[];
        $rows=\DB::select('SHOW COLUMNS FROM '.$tbl);
        foreach($rows as $r)
            if(!in_array($r->Field, ['id', 'created_at', 'updated_at', 'deleted_at']))
            $fields[]=$r->Field;

       

        $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);

        $st .= "<x-slot name=\"titre\">{$mdl}s</x-slot>\n
              <x-slot name=\"stitre\">@include('livewire.$mo.menu')</x-slot>\n<div>\n";
        $st .= "
<a class=\"btn btn-sm btn-success\" href=\"{{route('$mo.$tbl.add')}}\">Ajouter</a>
<br><br>
<input type=\"text\" wire:model.live=\"search\"/>
        <div class=\"table-responsive\">
        <table  class=\"table table-bordered table-striped\">\n";
        $st .= "<tr>\n";
        foreach ($fields as $f) {
            $st .= "\t<th>".\App\Uts::label($f)."</th>\n";
        }

        $st .= "<th></th></tr>\n";
        $st .= "@foreach(\$$tbl as \$item)\n";
        $st .= "<tr>\n";
        foreach ($fields as $f) {
            if (\Str::endsWith($f, '_id')) {
                $ff = str_replace('_id', '', $f);
                $relsf = \Schema::getColumnListing($ff.'s');
                $rfs = [];
                foreach ($relsf as $k => $v) {
                    $rfs[$v] = $v;
                }
                $rfs = \Arr::except($rfs, ['id', 'created_at', 'updated_at', 'deleted_at']);
                $rf = current($rfs);
                $st .= "\t<td>{{\$item->".Uts::camel($ff)."->{$rf}??''}}</td>\n";
            } 
            else if(\Str::startsWith($f, 'l_')){
                $ff = str_replace('l_', '', $f);
               $st .= "\t<td>{{\$item->le$ff}}</td>\n"; 
            }
            else {
                $st .= "\t<td>{{\$item->$f}}</td>\n";
            }
        }
        $st .= "<td><a class=\"btn btn-sm btn-primary\"  href=\"{{route('$mo.$tbl.show',\$item->id)}}\">Voir</a>\n";
        $st .= "</td>\n";
        $st .= "</tr>\n";

        $st .= "@endforeach\n";
        $st .= "</table></div>\n";
        $st .= "{{\${$tbl}->links()}}\n";
        $lmdl = strtolower($mdl);
        $st .= "    \n</div>";

        return $st;
    }

    public function desc($mo, $tbl, $mdl, $ext)
    {
        $lmdl = strtolower($mdl);
        //$mdl       = ucfirst(substr($tbl, 0, strlen($tbl) - 1));
        $st = '';
        $allfields = \Schema::getColumnListing($tbl);
        $fields = [];
        foreach ($allfields as $k => $v) {
            $fields[$v] = $v;
        }

        $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);
        $st .= "<x-slot name=\"titre\">{$mdl}s</x-slot>\n
              <x-slot name=\"stitre\">@include('livewire.$mo.menu')</x-slot>\n<div>\n";
        $st .= "<table  class=\"table table-bordered\">\n";

        // $st .= "@foreach(\$$tbl as \$item)\n";

        foreach ($fields as $f) {
            $st .= "<tr>\n";
            $st .= "\t<th>".\App\Uts::label($f)."</th>\n";
            if (\Str::endsWith($f, '_id')) {
                $ff = str_replace('_id', '', $f);
                $relsf = \Schema::getColumnListing($ff.'s');
                $rfs = [];
                foreach ($relsf as $k => $v) {
                    $rfs[$v] = $v;
                }
                $rfs = \Arr::except($rfs, ['id', 'created_at', 'updated_at', 'deleted_at']);
                
                $rf = current($rfs);
                $st .= "\t<td>{{\${$lmdl}->{$ff}->{$rf}??''}}</td>\n";
            } 
            if(\Str::startsWith($f, 'l_')){
                $ff = str_replace('l_', '', $f);
  $st .= "\t<td>{{\${$lmdl}->le{$ff}</td>\n";
            }else {
                $st .= "\t<td>{{\${$lmdl}->$f}}</td>\n";
            }
            $st .= "</tr>\n";
        }

        //   $st .= "@endforeach\n";
        $st .= "</table>\n";
        $st .= "<a class=\"btn btn-sm btn-primary\" href=\"{{route('$mo.$tbl')}}\">Liste</a>\n";
        $st .= "<a class=\"btn btn-sm btn-primary\" href=\"{{route('$mo.$tbl.edit',\${$lmdl}->id)}}\">Modifier</a>\n";
        $st .= " <button  class=\"btn btn-sm btn-danger\" wire:click=\"destroy{$mdl}({{\${$lmdl}->id}})\">Supprimer</button>  \n";
        $st .= '</div>';

        return $st;
    }

    public function descb($mo, $tbl, $mdl, $ext)
    {
        $st = "<x-slot name=\"acs\">@include('livewire.$mo.menu') </x-slot>
                    <x-card title=\"$tbl\">\n

                    Rechercher <input type=\"text\" wire:model=\"search\"/> \n     <br><br>     \n
                    @include('livewire.$tbl.form' )\n
                    <button class=\"btn btn-sm btn-primary\" wire:click=\"store{$mdl}()\">Ajouter<button/>
                    </x-card>
                </x-corps>
            </div>";

        return $st;
    }

    public function files($tbl, $mdl)
    {
        // $st = "touch home.blade.php show.blade.php add$mdl.blade.php edit$mdl.blade.php form.blade.php details.blade.php menu.blade.php table.blade.php";
        $fls = strtolower($mdl);
        $fld = $fls.'s';
        $st = "touch home.blade.php edit$mdl.blade.php  add$mdl.blade.php table.blade.php form.blade.php\n";
        $st .= "php artisan make:livewire  {$fls}.{$fls}-component\n";
        $st .= "Route::get('$fld',\\App\\Livewire\\{$mdl}\\{$mdl}List::class)->name('{$fld}');\n";
        $st .= "Route::get('$fld',\\App\\Livewire\\{$mdl}\\{$mdl}Show::class)->name('{$fld}.show');";

        return $st;
    }

    public function invrels($tbl, $mdl)
    {
        $rls = [];
        $tables = \DB::select('SHOW TABLES');
        $tbls = [];
        foreach ($tables as $table) {
            $tn='Tables_in_'.env('DB_DATABASE');
            $tbls[] = $table->$tn;
        }
        foreach ($tbls as $rel) {
            $allfields = \Schema::getColumnListing($rel);
            foreach ($allfields as $fl) {
                if (\Str::startsWith($tbl, str_replace('_id', '', $fl))) {
                    $rls[] = $rel;
                }
            }
        }

        return $rls;
    }

    public function rels()
    {
        $tables = \DB::select('SHOW TABLES');
        $tbls = [];
        foreach ($tables as $table) {
            $tn='Tables_in_'.env('DB_DATABASE');
            $tbls[] = $table->$tn;
        }

        $stb = file_get_contents(public_path().'/stubs/model.stub');
        foreach ($tbls as $rel) {
            $st = $stb;
            $mdl = ucfirst(substr($rel, 0, strlen($rel) - 1));
            $st = str_replace('#MODEL#', $mdl, $st);
            $allfields = \Schema::getColumnListing($rel);
            $fields = [];
            $i = 0;
            $lbl = '';
            foreach ($allfields as $k => $v) {
                $i++;
                if ($i == 2) {
                    $lbl = $v;
                }

                $fields[$v] = $v;
            }

            $fields = \Arr::except($fields, ['id', 'created_at', 'updated_at', 'deleted_at']);
            $stf = '';
            $stf .= "    function tab() {\n";
            $stf .= "\t return \\App\\Models\\$mdl::pluck('$lbl','id');\n";
            $stf .= "    }\n";

            foreach ($fields as $fl) {
                if (\Str::endsWith($fl, '_id')) {
                    $nf = str_replace('_id', '', $fl);
                    $pts = explode('_', $nf);
                    $nfm = '';
                    foreach ($pts as $p) {
                        $nfm .= ucfirst($p);
                    }

                    $nfml = strtolower($nfm[0]).substr($nfm, 1, strlen($nfm));
                    $stf .= "    function $nfml() {\n";
                    $stf .= "\t return \$this->belongsTo('\\App\\Models\\$nfm');\n";
                    $stf .= "    }\n";
                }
            }
            $st = str_replace('#RELS#', $stf, $st);
            file_put_contents(public_path().'/stubs/models/'.$mdl.'.php', $st);
            echo "<textarea cols=60 rows=20>$st</textarea><br>";
        }
    }

      public function page($tbl, $mdl, $view = '')
      {
          $st = "
           <div>
                <x-corps titrepage=\"$tbl\" titrelink=\"$tbl\">\n
                    <x-slot name=\"acs\">@include('livewire.$mo.menu') </x-slot>
                    <x-card title=\"$tbl\">\n
                        
                    Rechercher <input type=\"text\" wire:model=\"search\"/> \n     <br><br>     \n
                    @include('livewire.$tbl.$view' )\n                                                             
            </div>";

          return $st;
      }

      public function pageedit($tbl, $mdl)
      {
          $st = "
           <div>
                <x-corps titrepage=\"$tbl\" titrelink=\"$tbl\">\n
                    <x-slot name=\"acs\">@include('livewire.$mo.menu') </x-slot>
                    <x-card title=\"$tbl\">\n
                        
                  
                    @include('livewire.$tbl.form' )\n       
                    <button wire:click=\"update{$mdl}\">Modifier</button>         
                    </x-card>
                </x-corps>                                                                             
            </div>";

          return $st;
      }

      public function pagecreate($tbl, $mdl)
      {
          $st = "
           <div>
                <x-corps titrepage=\"$tbl\" titrelink=\"$tbl\">\n
                    <x-slot name=\"acs\">@include('livewire.$mo.menu') </x-slot>
                    <x-card title=\"$tbl\">\n
                        
                    
                    @include('livewire.$tbl.form' )\n        
                    <button wire:click=\"store{$mdl}\">Ajouter</button>        
                    </x-card>
                </x-corps>                                                                             
            </div>";

          return $st;
      }

    public function createFile($fic, $st)
    {
        //if(!file_exists($fic)){
        file_put_contents($fic, $st);
        // }
    }
    public function appendFile($fic, $st)
    {
        //if(!file_exists($fic)){
        $c=file_get_contents($fic)."\n".$st;
        ;
        file_put_contents($fic, $c);
        // }
    }
}
