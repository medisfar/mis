<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AnalyticsController;
function is_parseable_date(string $date): bool {
    return strtotime($date) !== false;
}
//==================================

  Route::get('xlxs/{id}',[App\Http\Controllers\XlsController::class,'xls'])->name('foyers.xls');
//======
Route::prefix('monitoring')->middleware('auth')->group(function(){
     Route::get('cadre',App\Livewire\Ptpa::class)->name('cadre');

     Route::get('ptpa/{id}',App\Livewire\Avancement::class)->name('ptpa');
});
     
//==================
Route::prefix('analytics')->group(function () {
    // List all available analytics
    Route::get('/', [AnalyticsController::class, 'index']);
    
    // Individual analytics endpoints
    Route::get('/projects', [AnalyticsController::class, 'projects']);
    Route::get('/sites', [AnalyticsController::class, 'sites']);
    Route::get('/groupements', [AnalyticsController::class, 'groupements']);
    Route::get('/activities', [AnalyticsController::class, 'activities']);
    Route::get('/members', [AnalyticsController::class, 'members']);
    Route::get('/financial', [AnalyticsController::class, 'financial']);
    Route::get('/localities', [AnalyticsController::class, 'localities']);
    Route::get('/tasks', [AnalyticsController::class, 'tasks']);
    Route::get('/dashboard', [AnalyticsController::class, 'dashboard']);
});
//==========


Route::get('ses/{mid}',App\Livewire\SessionsEnfant::class)->name('ses');

Route::get('fo',function(){
return \App\Models\Formulaire::find(5)->properties();
  });
Route::get('int2',function(){
  $ms=\DB::select("select * from excels");
 

  $i=1;
$dt=[];
 foreach ($ms as $m){
    $dt[$m->date_session][$m->mid][]=$m->data;
 } 
 //dd($dt);
 foreach ($dt as $d=>$m){
    if(is_parseable_date($d)){
       
         foreach ($m as $k=>$e){
            $me=\App\Models\Membre::find($k);
            if($me!=null){
                $g=$me->groupement->first();
                $ng=$g->nom_groupe??'';
                
                $l=\App\Models\Lessession::whereRaw(' date_session=? and groupement_id=?',[$d,$g->id])->first();
                if($l==null)
                 $l=\App\Models\Lessession::create([
                        'date_session'=>$d,
                        'nom'=>'s',
                        'site_id'=>$g->site_id,
                        'groupement_id'=>$g->id,                ]);
                  \App\Models\MetaDonnee::create([
                    'membre_id'=>$me->id,
                    'lessession_id'=>$l->id,
                    'donnes'=>$e[0]
                  ]);

                                    }
         }
    }else  echo $d.'no valid<br>';
 }
});



Route::get('/sci', function(){
    /*
foreach(\App\Models\Site::all() as $s){
   $g=new \App\Models\Groupement;
   $g->site_id=$s->id;
   $g->nom_groupe=$s->nom.'-foyer1';
   $g->projet_id=11;
        $g->statut=1;$g->save();
   $g=new \App\Models\Groupement;
   $g->site_id=$s->id;$g->projet_id=11;
        $g->statut=1;
   $g->nom_groupe=$s->nom.'-foyer2';$g->save();
   // echo $g->localite->nom_localite.'    '. $s->nom.'<br>';

}
dd('fin');
});  */

$row = 1;
$tbl='';
$c=[];
if (($handle = fopen(public_path()."/data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
         $d['quartier']=$data[0];
         $d['site']=substr($data[2],0,-1);
         $d['foyer']=$data[5];
         
         $d['nom']=$data[10];
         $d['code']=$data[12];
        $d['mere']=$data[7];
        $d['mc']=$data[3];
        $d['tel']=$data[8];
     
     $dt[$d['quartier']][$d['site']][$d['foyer']][]=$d;//\App\Models\Groupement::where('nom_groupe',str_replace('/','-s',$s))->first()->id??99;//  \App\Models\Groupement::where('nom_groupe',$s)->first()->id??99;
    }
    fclose($handle);}
    //dd($dt);
    unset($dt['Quartier']);
    
    foreach($dt as $loc=>$dtt){
        
         $lid=\App\Models\Localite::where(
            'nom_localite',$loc)->first()->id??99;
         $loc=strtolower(substr($loc,0,3));
         if($loc=='bâ') $loc='bac';
        echo "loc:".$loc."  $lid<br>";
     foreach($dtt as $site=>$dtt2){
      $site=




      strtolower($loc.'-'.$site);
        $s=\App\Models\Site::where('nom',$site)->first();
        if($s==null) {
            $s=new App\Models\Site;
          $s->type_point_focal=2;
          $s->nom_point_focal='facilitatrice';
          $s->nom=$site;
          $s->localite_id=$lid;
          $s->save();
          $ids=$s->id;
        }
        //foyer
        foreach($dtt2 as $foyer=>$dtt3){
           $ng=$site.'-'.$foyer;
        $g= \App\Models\Groupement::where('nom_groupe',$ng)->first();

        if($g==null){
             $g=new \App\Models\Groupement;
            $g->nom_groupe=$ng;
            $g->site_id=$s->id;
            $g->projet_id=11;
            $g->statut=1;
            $g->save();
        }
        //dd($dtt3);
        foreach($dtt3 as $de){
        //menage

           $m=\App\Models\Menage::where('chef',$de['mere'])->first();
                  if($m==null){
                  $m=new \App\Models\Menage;
                    $m->chef=$de['mere'];
                    $m->localite_id=$lid;
                    $m->conjoint='';//$data[6];
                   $m->tel1=$de['tel'];
                   $m->code=$de['code'];
                    $m->save();
    $me=\App\Models\Membre::create([
    'nom'=>$de['nom'],
    'menage_id'=>$m->id,
    'lien_parente'=>2,'genre'=>1]);
    $g->membres()->attach($me->id);

    }}
    }}}
    


});


//============================
Route::get('/moo', function(){
$i = 1;
$c=[];
$d=[];
$n=[];
if (($handle = fopen(public_path()."/listea.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

        //$data=str_replace('Dr.','',$data[0]);
            
 dd($data);
                $c['username'] = $data[0] . '28';        // "Omar28"
$c['firstname'] = $data[1];              // "aden"
$c['lastname'] = $data[2];              // "rayaleh" (fixed typo from 'lastnane')
$c['email'] = $c['username'] . '@chub.dj';  // "Omar28@chub.dj"
$c['password'] = $data[0] . $i++ . 'U042026';  // "Omar0U042026" (assuming $i starts at 0)
$c['role1'] = 'editingteacher';          // (removed backtick)
$c['course1'] = 'fchua';
                  $d[]=$c;      
        }}
        $ct="username;firtname;lastnane;email;password;role1;course1<br>";
$i=1;
foreach ($d as $row) 
    $ct .= implode(';',$row ).$i++."<br>";
     return $ct;
        });

Route::get('cours/{n}/{nb}',function($n,$nb){
$ct="shortname;fullname;category1<br>";
$i=1;
for($i=1;$i<=$nb;$i++) 
    $ct .= $n.$i.';'.$n.$i.";168<br>";
     return $ct;
});
Route::get('/test', function () {
    foreach(\App\Models\Menage::all() as $m){
        $m->chef=\App\Uts::gennom('M');
        $m->conjoint=\App\Uts::gennom('F');
        $m->save();
    }
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/projet/{id}/pdf',[App\Http\Controllers\PdfController::class,'projet'])->name('projet.pdf');
Route::get('/trees/{id}', function ($id) {
    return view('tree',['pid'=>$id]);
})->name('trees');

Route::get('projet/outils',App\Livewire\Outils::class);
Route::get('/liens',App\Livewire\Lien::class);
Route::get('/testapi',App\Livewire\ApiTester::class);

Route::get('/tree/{id}',App\Livewire\MasterDetailTree::class)->name('tree');
Route::get('/choisir-projet',App\Livewire\ChoisirProjet::class)->name('choisir-projet');
Route::get('/form-builder/{fid}', \App\Livewire\FormBuilder::class)->name('form.builder');

Route::get('/select-membres/sid/{sid}/gid/{gid}', \App\Livewire\SelectMembres::class)->name('select.membres');

Route::get('/show-membres/sid/{sid}/gid/{gid}', \App\Livewire\ShowMembres::class)->name('show.membres');

Route::get('/form-saisie/session/{sid}/membres/{mid}/forms/{fid}', \App\Livewire\FormPreview::class)->name('form.saisie');
Route::get('/forms', \App\Livewire\FormList::class)->name('forms.list'); 
Route::get('/form/{formId}', \App\Livewire\FormDisplay::class)->name('form.display');
Route::get('/gen/{nb}',function($nb){ 
 for ($i=0; $i<$nb ; $i++) { 
    $m=\App\Models\Menage::create([
        'id'=>$i,
        'chef'=>\App\Uts::gennom('M'),
         'conjoint'=>\App\Uts::gennom('M'),
         'tel1'=>'7781'.rand(1000,9999),
         'tel2'=>'7782'.rand(1000,9999),
        'toit_id'=>0,
        'localite_id'=>rand(1,5)
        
    ]);
   /* for ($j=0; $j <4 ; $j++) { 
        $s=rand(1,100)%2+1;
    $mb=\App\Models\Membre::create([
        'nom'=>\App\Uts::nom($s==1?'M':'F').' '.\App\Uts::pere($m->chef),
        'menage_id'=>$m->id,
        'genre'=>$s,
        'lien_parente'=>2,
        'date_naissance'=>rand(2000,2024).'-0'.rand(1,9).'-'.rand(10,28),
        'enceinte'=>$s==0?0:(rand(0,100)<5?1:0)
    ]);
}*/
  }
});
Route::get('/data', function(){
    return DB::select("select nom_region,nom_prefecture,nom_ssprefecture,nom_localite,pj.code,
cp.description, scp.description,a.activite,a.budget
from regions r, prefectures p, ssprefectures sp,localites l, projets pj, composantes cp, souscomposantes scp, activites a
where r.id=p.region_id
and p.id=sp.prefecture_id
and sp.id=l.ssprefecture_id
and l.id=a.localite_id
and cp.id=scp.composante_id");
});
/*
Route::get('tr', function() {
    $membres = \App\Models\Membre::with('menage')->get();
    $total = count($membres);
    
    for ($j = 0; $j < $total - 1; $j += 2) { // Traite 2 par 2
        // Vérifier si l'élément suivant existe
        if (isset($membres[$j + 1])) {
            $membre1 = $membres[$j];
            $membre2 = $membres[$j + 1];
            
            // Comparer les chefs de ménage des deux membres
            if ($membre1->menage->chef == $membre2->menage->chef) {
                // Assigner le menage_id du premier au second
                $membre2->menage_id = $membre1->menage_id;
                $membre2->save();
            }
        }
    }
    
    return "Traitement terminé pour " . $total . " membres";
})
*/
Route::get('/list', function(){
    echo '<table>';
 foreach(\App\Models\Membre::all() as $e)   {
    echo '<tr>';
    echo '<td>'.($e->id??'').'</td>';
    echo '<td>'.($e->groupement->first()->nom_groupe??'').'</td>';
    //echo '<td>'.($e->groupement->nom??'').'</td>';
    echo '<td>'.$e->menage->code.'</td>';
    echo '<td>'.$e->menage->chef.'</td>';
    echo '<td>'.$e->code.'</td>';
    echo '<td>'.$e->nom.'</td>';
    echo '<td>'.$e->menage->tel1.'</td>';
 }
 echo '<tr>';
});


Route::get('/sc', function(){
    /*
foreach(\App\Models\Site::all() as $s){
   $g=new \App\Models\Groupement;
   $g->site_id=$s->id;
   $g->nom_groupe=$s->nom.'-foyer1';
   $g->projet_id=11;
        $g->statut=1;$g->save();
   $g=new \App\Models\Groupement;
   $g->site_id=$s->id;$g->projet_id=11;
        $g->statut=1;
   $g->nom_groupe=$s->nom.'-foyer2';$g->save();
   // echo $g->localite->nom_localite.'    '. $s->nom.'<br>';

}
dd('fin');
});  */

$row = 1;
$tbl='';
$c=[];
if (($handle = fopen(public_path()."/menages.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
         $s= $data[0].'/'.$data[2].'-'.$data[5];//.'<br>';
         $s=substr($s,0,strlen($s)-1);
      
      $s=   str_replace('foy1','foyer1',$s);// 
      $s=   str_replace('foy2','foyer2',$s);// 
      $s=   str_replace('s','',$s);// 
      $s=   str_replace('--','-',$s);// 

     $dt[$row++]=\App\Models\Groupement::where('nom_groupe',str_replace('/','-s',$s))->first()->id??99;//  \App\Models\Groupement::where('nom_groupe',$s)->first()->id??99;
    }
    fclose($handle);}
    foreach($dt as $k=>$v)
        \DB::insert("insert into groupement_membre (groupement_id,membre_id) values ($v,$k)");
    dd($dt);

});
/*

foreach(\App\Models\Site::all() as $s){
    //echo substr($s->nom,strpos('/',$s->nom),strlen($s->nom)).'-foy1<br>';
    
     $g=new \App\Models\Groupement;
        $g->nom_groupe=substr($s->nom,strpos('/',$s->nom),strlen($s->nom)).'-foy1';
        $g->site_id=$s->id;
        $g->projet_id=11;
        $g->statut=1;
        $g->save();
forech($dt as $d){
    $loc=explode('/',$d)[0];
    $s=new App\Models\Site;
    $s->type_point_focal=2;
          $s->nom_point_focal='f';
          $s->nom=$d;
          $s->localite_id=\App\Models\Localite::where('nom_localite',$loc)->first()->id??99;
          $s->save();
          $ids=$s->id;

}
//if($row++>100) break;
/*
Route::get('/imp', function(){
$row = 1;
$tbl='';
$c=[];
if (($handle = fopen(public_path()."/menages.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
//if($row++>100) break;

                $m=\App\Models\Menage::where('chef',$data[6])->first();
                  if($m==null){
                  $m=new \App\Models\Menage;
                    $m->chef=$data[6];
                    $m->localite_id=\App\Models\Localite::where('nom_localite',$data[0])->first()->id??99;
                    $m->conjoint='';
                   $m->tel1=$data[7];
                   $m->code=$data[8];
                    $m->save();
                }
        //SITE
          echo $row.' rech '.$data[2].'<br>';
           $s=\App\Models\Site::where('id',trim($data[2]))->first();
           if($s==null){
            echo $row.'new site '.$data[2].'<br>';
          $s=new \App\Models\Site;
          $s->type_point_focal=2;
          $s->nom_point_focal='F';
          $s->nom='s'.$data[3];
          $s->localite_id=$m->localite_id;
          $s->save();
          $ids=$s->id;

      }
      else $ids=$data[2]; 

      //groupe
       $g=\App\Models\Groupement::where('nom_groupe',$data[5])->first();
       if($g==null){
        $g=new \App\Models\Groupement;
        $g->nom_groupe=$data[5];
        $g->site_id=$s->id;
        $g->projet_id=11;
        $g->statut=1;
        $g->save();
       }

            $e=new \App\Models\Membre;
            $e->menage_id=$m->id;
             $e->nom=$data[9];
              $e->lien_parente=2;
              $e->code=$data[10];

             $e->save();

             $g->membres()->attach($e->id);
             echo $row.' '.$data[0].'      /'.$data[2]

}}

    fclose($handle);

});*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/gp/public/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/gp/public/livewire/update', $handle);
});
Route::get('map/{idl}',App\Livewire\LocationMap::class)->name('map');

Route::get('simple-map/{lat}/{lng}',App\Livewire\SimpleMap::class)->name('smap');
//======================== Modules ===========
Route::prefix('monitoring')->middleware('auth')->group(function(){
     Route::get('avancement/{id}',App\Livewire\Avancement::class)->name('av');
 });
Route::prefix('monitoring')->middleware('auth')->group(function(){
    Route::get('/objectifs',App\Livewire\Monitoring\ObjectifsTabs::class)->
        name('monitoring.objectifs.tabs');
     Route::get('gantt/{id}',App\Livewire\MedGantt::class)->name('gantt');
 });
Route::prefix('datacollect')->middleware('auth')->group(function(){
     
          Route::get('menages/tabs',
        App\Livewire\Datacollect\MenagesTabs::class)->
        name('datacollect.menages.tabs');

    Route::get('/beneficiaires/tabs',
        App\Livewire\Datacollect\BeneficiairesTabs::class)
        ->name('datacollect.beneficiaires.tabs');
    Route::get('/sessions/tabs/',
        App\Livewire\Datacollect\SessionsTabs::class)
    ->name('datacollect.sessions.tabs');
});
Route::prefix('projet')->middleware('auth')->group(function(){
     Route::get('/objectifs',       App\Livewire\Projet\ObjectifsTabs::class)->
        name('projet.objectifs.tabs');});
Route::prefix('projet')->middleware('auth')->group(function(){
     Route::get('/indicateurs',       App\Livewire\Projet\IndicateursTabs::class)->
        name('projet.indicateurs.tabs');});
    //===============================
Route::get('/monitoring',App\Livewire\MonitoringIndex::class)->name('monitoring.index');
Route::get('/excel',
        App\Livewire\ExcelValueReplacer::class)
        ->name('excel');
Route::get('/dev/mig',App\Livewire\MigrationManager::class)->name('dev.mig');
//Route::get('/composante/{id}/gantt',App\Livewire\Gantt::class)->name('composante.gantt');
Route::prefix('geolocalisation')->middleware('auth')->group(function(){
    Route::get('/',App\Livewire\Geolocalisation::class)->name('geolocalisation');
    
     Route::get('/regions',App\Livewire\Geolocalisation\Regions\RegionListe::class)->name('geolocalisation.regions');
    Route::get('/regions/add',App\Livewire\Geolocalisation\Regions\RegionAdd::class)->name('geolocalisation.regions.add');
    Route::get('/regions/{id}/edit',App\Livewire\Geolocalisation\Regions\RegionEdit::class)->name('geolocalisation.regions.edit');
    Route::get('/regions/{id}/show',App\Livewire\Geolocalisation\Regions\RegionShow::class)->name('geolocalisation.regions.show');});








Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/localites',App\Livewire\Geolocalisation\Localites\LocaliteListe::class)->name('geolocalisation.localites');Route::get('/localites/add',App\Livewire\Geolocalisation\Localites\LocaliteAdd::class)->name('geolocalisation.localites.add');Route::get('/localites/{id}/edit',App\Livewire\Geolocalisation\Localites\LocaliteEdit::class)->name('geolocalisation.localites.edit');Route::get('/localites/{id}/show',App\Livewire\Geolocalisation\Localites\LocaliteShow::class)->name('geolocalisation.localites.show');});


Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/zones',App\Livewire\Geolocalisation\Zones\ZoneListe::class)->name('geolocalisation.zones');Route::get('/zones/add',App\Livewire\Geolocalisation\Zones\ZoneAdd::class)->name('geolocalisation.zones.add');Route::get('/zones/{id}/edit',App\Livewire\Geolocalisation\Zones\ZoneEdit::class)->name('geolocalisation.zones.edit');Route::get('/zones/{id}/show',App\Livewire\Geolocalisation\Zones\ZoneShow::class)->name('geolocalisation.zones.show');});


Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/',App\Livewire\Parametrage::class)->name('projet.home');
    Route::get('/projets',App\Livewire\Projet\Projets\ProjetListe::class)->name('projet.projets');
    Route::get('/projets/add',App\Livewire\Projet\Projets\ProjetAdd::class)->name('projet.projets.add');
    Route::get('/projets/{id}/edit',App\Livewire\Projet\Projets\ProjetEdit::class)->name('projet.projets.edit');
    Route::get('/projets/{id}/show',App\Livewire\Projet\Projets\ProjetShow::class)->name('projet.projets.show');});


Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/activites',App\Livewire\Projet\Activites\ActiviteListe::class)->name('projet.activites');
    Route::get('/activites/add',App\Livewire\Projet\Activites\ActiviteAdd::class)->name('projet.activites.add');
    Route::get('/activites/{id}/edit',App\Livewire\Projet\Activites\ActiviteEdit::class)->name('projet.activites.edit');
    Route::get('/activites/{id}/show',App\Livewire\Projet\Activites\ActiviteShow::class)->name('projet.activites.show');});



Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/composantes',App\Livewire\Projet\Composantes\ComposanteListe::class)->name('projet.composantes');

    Route::get('/composantes/add',App\Livewire\Projet\Composantes\ComposanteAdd::class)->name('projet.composantes.add');
    Route::get('/composantes/{id}/edit',App\Livewire\Projet\Composantes\ComposanteEdit::class)->name('projet.composantes.edit');
    Route::get('/composantes/{id}/show',App\Livewire\Projet\Composantes\ComposanteShow::class)->name('projet.composantes.show');});


Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/souscomposantes',App\Livewire\Projet\Souscomposantes\SouscomposanteListe::class)->name('projet.souscomposantes');
    Route::get('/souscomposantes/add',App\Livewire\Projet\Souscomposantes\SouscomposanteAdd::class)->name('projet.souscomposantes.add');
    Route::get('/souscomposantes/{id}/edit',App\Livewire\Projet\Souscomposantes\SouscomposanteEdit::class)->name('projet.souscomposantes.edit');
    Route::get('/souscomposantes/{id}/show',App\Livewire\Projet\Souscomposantes\SouscomposanteShow::class)->name('projet.souscomposantes.show');});


Route::prefix('geolocalisation')->middleware('auth')->group(function(){
    Route::get('/ssprefectures',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureListe::class)->name('geolocalisation.ssprefectures');
    Route::get('/ssprefectures/add',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureAdd::class)->name('geolocalisation.ssprefectures.add');
    Route::get('/ssprefectures/{id}/edit',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureEdit::class)->name('geolocalisation.ssprefectures.edit');Route::get('/ssprefectures/{id}/show',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureShow::class)->name('geolocalisation.ssprefectures.show');});




Route::prefix('geolocalisation')->middleware('auth')->group(function(){
    Route::get('/prefectures',App\Livewire\Geolocalisation\Prefectures\PrefectureListe::class)->name('geolocalisation.prefectures');
    Route::get('/prefectures/add',App\Livewire\Geolocalisation\Prefectures\PrefectureAdd::class)->name('geolocalisation.prefectures.add');
    Route::get('/prefectures/{id}/edit',App\Livewire\Geolocalisation\Prefectures\PrefectureEdit::class)->name('geolocalisation.prefectures.edit');
    Route::get('/prefectures/{id}/show',App\Livewire\Geolocalisation\Prefectures\PrefectureShow::class)->name('geolocalisation.prefectures.show');});



Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/taches',App\Livewire\Projet\Taches\TacheListe::class)->name('projet.taches');Route::get('/taches/add',App\Livewire\Projet\Taches\TacheAdd::class)->name('projet.taches.add');Route::get('/taches/{id}/edit',App\Livewire\Projet\Taches\TacheEdit::class)->name('projet.taches.edit');Route::get('/taches/{id}/show',App\Livewire\Projet\Taches\TacheShow::class)->name('projet.taches.show');});

/*
Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/bailleurs',App\Livewire\Projet\Bailleurs\BailleurListe::class)->name('projet.bailleurs');Route::get('/bailleurs/add',App\Livewire\Projet\Bailleurs\BailleurAdd::class)->name('projet.bailleurs.add');Route::get('/bailleurs/{id}/edit',App\Livewire\Projet\Bailleurs\BailleurEdit::class)->name('projet.bailleurs.edit');Route::get('/bailleurs/{id}/show',App\Livewire\Projet\Bailleurs\BailleurShow::class)->name('projet.bailleurs.show');});
*/

Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/missions',App\Livewire\Monitoring\Missions\MissionListe::class)->name('monitoring.missions');Route::get('/missions/add',App\Livewire\Monitoring\Missions\MissionAdd::class)->name('monitoring.missions.add');Route::get('/missions/{id}/edit',App\Livewire\Monitoring\Missions\MissionEdit::class)->name('monitoring.missions.edit');Route::get('/missions/{id}/show',App\Livewire\Monitoring\Missions\MissionShow::class)->name('monitoring.missions.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/secteurs',App\Livewire\Monitoring\Secteurs\SecteurListe::class)->name('monitoring.secteurs');Route::get('/secteurs/add',App\Livewire\Monitoring\Secteurs\SecteurAdd::class)->name('monitoring.secteurs.add');Route::get('/secteurs/{id}/edit',App\Livewire\Monitoring\Secteurs\SecteurEdit::class)->name('monitoring.secteurs.edit');Route::get('/secteurs/{id}/show',App\Livewire\Monitoring\Secteurs\SecteurShow::class)->name('monitoring.secteurs.show');});



Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/resultats',App\Livewire\Monitoring\Resultats\ResultatListe::class)->name('monitoring.resultats');Route::get('/resultats/add',App\Livewire\Monitoring\Resultats\ResultatAdd::class)->name('monitoring.resultats.add');Route::get('/resultats/{id}/edit',App\Livewire\Monitoring\Resultats\ResultatEdit::class)->name('monitoring.resultats.edit');Route::get('/resultats/{id}/show',App\Livewire\Monitoring\Resultats\ResultatShow::class)->name('monitoring.resultats.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/produits',App\Livewire\Monitoring\Produits\ProduitListe::class)->name('monitoring.produits');Route::get('/produits/add',App\Livewire\Monitoring\Produits\ProduitAdd::class)->name('monitoring.produits.add');Route::get('/produits/{id}/edit',App\Livewire\Monitoring\Produits\ProduitEdit::class)->name('monitoring.produits.edit');Route::get('/produits/{id}/show',App\Livewire\Monitoring\Produits\ProduitShow::class)->name('monitoring.produits.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/toits',App\Livewire\Beneficiaire\Toits\ToitListe::class)->name('beneficiaire.toits');Route::get('/toits/add',App\Livewire\Beneficiaire\Toits\ToitAdd::class)->name('beneficiaire.toits.add');Route::get('/toits/{id}/edit',App\Livewire\Beneficiaire\Toits\ToitEdit::class)->name('beneficiaire.toits.edit');Route::get('/toits/{id}/show',App\Livewire\Beneficiaire\Toits\ToitShow::class)->name('beneficiaire.toits.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/menages',App\Livewire\Beneficiaire\Menages\MenageListe::class)->name('beneficiaire.menages');Route::get('/menages/add',App\Livewire\Beneficiaire\Menages\MenageAdd::class)->name('beneficiaire.menages.add');Route::get('/menages/{id}/edit',App\Livewire\Beneficiaire\Menages\MenageEdit::class)->name('beneficiaire.menages.edit');Route::get('/menages/{id}/show',App\Livewire\Beneficiaire\Menages\MenageShow::class)->name('beneficiaire.menages.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/membres',App\Livewire\Beneficiaire\Membres\MembreListe::class)->name('beneficiaire.membres');Route::get('/membres/add',App\Livewire\Beneficiaire\Membres\MembreAdd::class)->name('beneficiaire.membres.add');Route::get('/membres/{id}/edit',App\Livewire\Beneficiaire\Membres\MembreEdit::class)->name('beneficiaire.membres.edit');Route::get('/membres/{id}/show',App\Livewire\Beneficiaire\Membres\MembreShow::class)->name('beneficiaire.membres.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){
    Route::get('/groupements',App\Livewire\Beneficiaire\Groupements\GroupementListe::class)->name('beneficiaire.groupements');
    Route::get('/groupements/{id}/addmembres',App\Livewire\Beneficiaire\Groupements\GroupementAdd::class)->name('beneficiaire.groupements.add');
    // Route::get('/groupements/add',App\Livewire\Beneficiaire\Groupements\GroupementAdd::class)->name('beneficiaire.groupements.addmembres');
    Route::get('/groupements/{id}/edit',App\Livewire\Beneficiaire\Groupements\GroupementEdit::class)->name('beneficiaire.groupements.edit');
     Route::get('/groupements/{id}/addmembres',App\Livewire\Beneficiaire\Groupements\GroupementAddMembres::class)->name('beneficiaire.groupements.addmembres');
    Route::get('/groupements/{id}/show',App\Livewire\Beneficiaire\Groupements\GroupementShow::class)->name('beneficiaire.groupements.show');});



Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/decomptes',App\Livewire\Projet\Decomptes\DecompteListe::class)->name('projet.decomptes');Route::get('/decomptes/add',App\Livewire\Projet\Decomptes\DecompteAdd::class)->name('projet.decomptes.add');Route::get('/decomptes/{id}/edit',App\Livewire\Projet\Decomptes\DecompteEdit::class)->name('projet.decomptes.edit');Route::get('/decomptes/{id}/show',App\Livewire\Projet\Decomptes\DecompteShow::class)->name('projet.decomptes.show');});






Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/psessions',App\Livewire\Datacollect\Psessions\PsessionListe::class)->name('datacollect.psessions');Route::get('/psessions/add',App\Livewire\Datacollect\Psessions\PsessionAdd::class)->name('datacollect.psessions.add');Route::get('/psessions/{id}/edit',App\Livewire\Datacollect\Psessions\PsessionEdit::class)->name('datacollect.psessions.edit');Route::get('/psessions/{id}/show',App\Livewire\Datacollect\Psessions\PsessionShow::class)->name('datacollect.psessions.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/fields',App\Livewire\Datacollect\Fields\FieldListe::class)->name('datacollect.fields');Route::get('/fields/add',App\Livewire\Datacollect\Fields\FieldAdd::class)->name('datacollect.fields.add');Route::get('/fields/{id}/edit',App\Livewire\Datacollect\Fields\FieldEdit::class)->name('datacollect.fields.edit');Route::get('/fields/{id}/show',App\Livewire\Datacollect\Fields\FieldShow::class)->name('datacollect.fields.show');});



Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/groupements',App\Livewire\Beneficiaire\Groupements\GroupementListe::class)->name('beneficiaire.groupements');Route::get('/groupements/add',App\Livewire\Beneficiaire\Groupements\GroupementAdd::class)->name('beneficiaire.groupements.add');Route::get('/groupements/{id}/edit',App\Livewire\Beneficiaire\Groupements\GroupementEdit::class)->name('beneficiaire.groupements.edit');Route::get('/groupements/{id}/show',App\Livewire\Beneficiaire\Groupements\GroupementShow::class)->name('beneficiaire.groupements.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/groupements',App\Livewire\Beneficiaire\Groupements\GroupementListe::class)->name('beneficiaire.groupements');Route::get('/groupements/add',App\Livewire\Beneficiaire\Groupements\GroupementAdd::class)->name('beneficiaire.groupements.add');Route::get('/groupements/{id}/edit',App\Livewire\Beneficiaire\Groupements\GroupementEdit::class)->name('beneficiaire.groupements.edit');Route::get('/groupements/{id}/show',App\Livewire\Beneficiaire\Groupements\GroupementShow::class)->name('beneficiaire.groupements.show');});


Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/sites',App\Livewire\Beneficiaire\Sites\SiteListe::class)->name('beneficiaire.sites');Route::get('/sites/add',App\Livewire\Beneficiaire\Sites\SiteAdd::class)->name('beneficiaire.sites.add');Route::get('/sites/{id}/edit',App\Livewire\Beneficiaire\Sites\SiteEdit::class)->name('beneficiaire.sites.edit');Route::get('/sites/{id}/show',App\Livewire\Beneficiaire\Sites\SiteShow::class)->name('beneficiaire.sites.show');});




Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/toits',App\Livewire\Datacollect\Toits\ToitListe::class)->name('datacollect.toits');Route::get('/toits/add',App\Livewire\Datacollect\Toits\ToitAdd::class)->name('datacollect.toits.add');Route::get('/toits/{id}/edit',App\Livewire\Datacollect\Toits\ToitEdit::class)->name('datacollect.toits.edit');Route::get('/toits/{id}/show',App\Livewire\Datacollect\Toits\ToitShow::class)->name('datacollect.toits.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/menages',App\Livewire\Datacollect\Menages\MenageListe::class)->name('datacollect.menages');Route::get('/menages/add',App\Livewire\Datacollect\Menages\MenageAdd::class)->name('datacollect.menages.add');Route::get('/menages/{id}/edit',App\Livewire\Datacollect\Menages\MenageEdit::class)->name('datacollect.menages.edit');Route::get('/menages/{id}/show',App\Livewire\Datacollect\Menages\MenageShow::class)->name('datacollect.menages.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/membres',App\Livewire\Datacollect\Membres\MembreListe::class)->name('datacollect.membres');Route::get('/membres/add',App\Livewire\Datacollect\Membres\MembreAdd::class)->name('datacollect.membres.add');Route::get('/membres/{id}/edit',App\Livewire\Datacollect\Membres\MembreEdit::class)->name('datacollect.membres.edit');Route::get('/membres/{id}/show',App\Livewire\Datacollect\Membres\MembreShow::class)->name('datacollect.membres.show');});




Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/fields',App\Livewire\Datacollect\Fields\FieldListe::class)->name('datacollect.fields');Route::get('/fields/add',App\Livewire\Datacollect\Fields\FieldAdd::class)->name('datacollect.fields.add');Route::get('/fields/{id}/edit',App\Livewire\Datacollect\Fields\FieldEdit::class)->name('datacollect.fields.edit');Route::get('/fields/{id}/show',App\Livewire\Datacollect\Fields\FieldShow::class)->name('datacollect.fields.show');});



Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/sites',App\Livewire\Datacollect\Sites\SiteListe::class)->name('datacollect.sites');Route::get('/sites/add',App\Livewire\Datacollect\Sites\SiteAdd::class)->name('datacollect.sites.add');Route::get('/sites/{id}/edit',App\Livewire\Datacollect\Sites\SiteEdit::class)->name('datacollect.sites.edit');Route::get('/sites/{id}/show',App\Livewire\Datacollect\Sites\SiteShow::class)->name('datacollect.sites.show');});

/*
Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/groupements',App\Livewire\Datacollect\Groupements\GroupementListe::class)->name('datacollect.groupements');Route::get('/groupements/add',App\Livewire\Datacollect\Groupements\GroupementAdd::class)->name('datacollect.groupements.add');Route::get('/groupements/{id}/edit',App\Livewire\Datacollect\Groupements\GroupementEdit::class)->name('datacollect.groupements.edit');Route::get('/groupements/{id}/show',App\Livewire\Datacollect\Groupements\GroupementShow::class)->name('datacollect.groupements.show');
Route::get('/groupements/{id}/addmembres',App\Livewire\Datacollect\Groupements\GroupementAddMembres::class)->name('datacollect.groupements.groupement-add-membres');});
*/

Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/zones',App\Livewire\Geolocalisation\Zones\ZoneListe::class)->name('geolocalisation.zones');Route::get('/zones/add',App\Livewire\Geolocalisation\Zones\ZoneAdd::class)->name('geolocalisation.zones.add');Route::get('/zones/{id}/edit',App\Livewire\Geolocalisation\Zones\ZoneEdit::class)->name('geolocalisation.zones.edit');Route::get('/zones/{id}/show',App\Livewire\Geolocalisation\Zones\ZoneShow::class)->name('geolocalisation.zones.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/toits',App\Livewire\Datacollect\Toits\ToitListe::class)->name('datacollect.toits');Route::get('/toits/add',App\Livewire\Datacollect\Toits\ToitAdd::class)->name('datacollect.toits.add');Route::get('/toits/{id}/edit',App\Livewire\Datacollect\Toits\ToitEdit::class)->name('datacollect.toits.edit');Route::get('/toits/{id}/show',App\Livewire\Datacollect\Toits\ToitShow::class)->name('datacollect.toits.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/menages',App\Livewire\Datacollect\Menages\MenageListe::class)->name('datacollect.menages');Route::get('/menages/add',App\Livewire\Datacollect\Menages\MenageAdd::class)->name('datacollect.menages.add');Route::get('/menages/{id}/edit',App\Livewire\Datacollect\Menages\MenageEdit::class)->name('datacollect.menages.edit');Route::get('/menages/{id}/show',App\Livewire\Datacollect\Menages\MenageShow::class)->name('datacollect.menages.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/menages',App\Livewire\Datacollect\Menages\MenageListe::class)->name('datacollect.menages');Route::get('/menages/add',App\Livewire\Datacollect\Menages\MenageAdd::class)->name('datacollect.menages.add');Route::get('/menages/{id}/edit',App\Livewire\Datacollect\Menages\MenageEdit::class)->name('datacollect.menages.edit');Route::get('/menages/{id}/show',App\Livewire\Datacollect\Menages\MenageShow::class)->name('datacollect.menages.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/menages',App\Livewire\Datacollect\Menages\MenageListe::class)->name('datacollect.menages');Route::get('/menages/add',App\Livewire\Datacollect\Menages\MenageAdd::class)->name('datacollect.menages.add');Route::get('/menages/{id}/edit',App\Livewire\Datacollect\Menages\MenageEdit::class)->name('datacollect.menages.edit');Route::get('/menages/{id}/show',App\Livewire\Datacollect\Menages\MenageShow::class)->name('datacollect.menages.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/missions',App\Livewire\Projet\Missions\MissionListe::class)->name('projet.missions');Route::get('/missions/add',App\Livewire\Projet\Missions\MissionAdd::class)->name('projet.missions.add');Route::get('/missions/{id}/edit',App\Livewire\Projet\Missions\MissionEdit::class)->name('projet.missions.edit');Route::get('/missions/{id}/show',App\Livewire\Projet\Missions\MissionShow::class)->name('projet.missions.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/secteurs',App\Livewire\Projet\Secteurs\SecteurListe::class)->name('projet.secteurs');Route::get('/secteurs/add',App\Livewire\Projet\Secteurs\SecteurAdd::class)->name('projet.secteurs.add');Route::get('/secteurs/{id}/edit',App\Livewire\Projet\Secteurs\SecteurEdit::class)->name('projet.secteurs.edit');Route::get('/secteurs/{id}/show',App\Livewire\Projet\Secteurs\SecteurShow::class)->name('projet.secteurs.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/produits',App\Livewire\Projet\Produits\ProduitListe::class)->name('projet.produits');Route::get('/produits/add',App\Livewire\Projet\Produits\ProduitAdd::class)->name('projet.produits.add');Route::get('/produits/{id}/edit',App\Livewire\Projet\Produits\ProduitEdit::class)->name('projet.produits.edit');Route::get('/produits/{id}/show',App\Livewire\Projet\Produits\ProduitShow::class)->name('projet.produits.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/resultats',App\Livewire\Projet\Resultats\ResultatListe::class)->name('projet.resultats');Route::get('/resultats/add',App\Livewire\Projet\Resultats\ResultatAdd::class)->name('projet.resultats.add');Route::get('/resultats/{id}/edit',App\Livewire\Projet\Resultats\ResultatEdit::class)->name('projet.resultats.edit');Route::get('/resultats/{id}/show',App\Livewire\Projet\Resultats\ResultatShow::class)->name('projet.resultats.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/composantes',App\Livewire\Monitoring\Composantes\ComposanteListe::class)->name('monitoring.composantes');Route::get('/composantes/add',App\Livewire\Monitoring\Composantes\ComposanteAdd::class)->name('monitoring.composantes.add');Route::get('/composantes/{id}/edit',App\Livewire\Monitoring\Composantes\ComposanteEdit::class)->name('monitoring.composantes.edit');Route::get('/composantes/{id}/show',App\Livewire\Monitoring\Composantes\ComposanteShow::class)->name('monitoring.composantes.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/sites',App\Livewire\Datacollect\Sites\SiteListe::class)->name('datacollect.sites');Route::get('/sites/add',App\Livewire\Datacollect\Sites\SiteAdd::class)->name('datacollect.sites.add');Route::get('/sites/{id}/edit',App\Livewire\Datacollect\Sites\SiteEdit::class)->name('datacollect.sites.edit');Route::get('/sites/{id}/show',App\Livewire\Datacollect\Sites\SiteShow::class)->name('datacollect.sites.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/collectes',App\Livewire\Datacollect\Collectes\CollecteListe::class)->name('datacollect.collectes');Route::get('/collectes/add',App\Livewire\Datacollect\Collectes\CollecteAdd::class)->name('datacollect.collectes.add');Route::get('/collectes/{id}/edit',App\Livewire\Datacollect\Collectes\CollecteEdit::class)->name('datacollect.collectes.edit');Route::get('/collectes/{id}/show',App\Livewire\Datacollect\Collectes\CollecteShow::class)->name('datacollect.collectes.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/donnees',App\Livewire\Datacollect\Donnees\DonneeListe::class)->name('datacollect.donnees');Route::get('/donnees/add',App\Livewire\Datacollect\Donnees\DonneeAdd::class)->name('datacollect.donnees.add');Route::get('/donnees/{id}/edit',App\Livewire\Datacollect\Donnees\DonneeEdit::class)->name('datacollect.donnees.edit');Route::get('/donnees/{id}/show',App\Livewire\Datacollect\Donnees\DonneeShow::class)->name('datacollect.donnees.show');});


Route::get('/choixmembre/{id}',App\Livewire\ChoixMembre::class);
Route::get('/dynform/{sesid}/{memid}',App\Livewire\DynForm::class);
Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/decomptes',App\Livewire\Monitoring\Decomptes\DecompteListe::class)->name('monitoring.decomptes');Route::get('/decomptes/add',App\Livewire\Monitoring\Decomptes\DecompteAdd::class)->name('monitoring.decomptes.add');Route::get('/decomptes/{id}/edit',App\Livewire\Monitoring\Decomptes\DecompteEdit::class)->name('monitoring.decomptes.edit');Route::get('/decomptes/{id}/show',App\Livewire\Monitoring\Decomptes\DecompteShow::class)->name('monitoring.decomptes.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/decomptes',App\Livewire\Monitoring\Decomptes\DecompteListe::class)->name('monitoring.decomptes');Route::get('/decomptes/add',App\Livewire\Monitoring\Decomptes\DecompteAdd::class)->name('monitoring.decomptes.add');Route::get('/decomptes/{id}/edit',App\Livewire\Monitoring\Decomptes\DecompteEdit::class)->name('monitoring.decomptes.edit');Route::get('/decomptes/{id}/show',App\Livewire\Monitoring\Decomptes\DecompteShow::class)->name('monitoring.decomptes.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/periodes',App\Livewire\Monitoring\Periodes\PeriodeListe::class)->name('monitoring.periodes');Route::get('/periodes/add',App\Livewire\Monitoring\Periodes\PeriodeAdd::class)->name('monitoring.periodes.add');Route::get('/periodes/{id}/edit',App\Livewire\Monitoring\Periodes\PeriodeEdit::class)->name('monitoring.periodes.edit');Route::get('/periodes/{id}/show',App\Livewire\Monitoring\Periodes\PeriodeShow::class)->name('monitoring.periodes.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/indicateurs',App\Livewire\Monitoring\Indicateurs\IndicateurListe::class)->name('monitoring.indicateurs');Route::get('/indicateurs/add',App\Livewire\Monitoring\Indicateurs\IndicateurAdd::class)->name('monitoring.indicateurs.add');Route::get('/indicateurs/{id}/edit',App\Livewire\Monitoring\Indicateurs\IndicateurEdit::class)->name('monitoring.indicateurs.edit');Route::get('/indicateurs/{id}/show',App\Livewire\Monitoring\Indicateurs\IndicateurShow::class)->name('monitoring.indicateurs.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/mesures',App\Livewire\Monitoring\Mesures\MesureListe::class)->name('monitoring.mesures');Route::get('/mesures/add',App\Livewire\Monitoring\Mesures\MesureAdd::class)->name('monitoring.mesures.add');Route::get('/mesures/{id}/edit',App\Livewire\Monitoring\Mesures\MesureEdit::class)->name('monitoring.mesures.edit');Route::get('/mesures/{id}/show',App\Livewire\Monitoring\Mesures\MesureShow::class)->name('monitoring.mesures.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/indicateurs',App\Livewire\Monitoring\Indicateurs\IndicateurListe::class)->name('monitoring.indicateurs');Route::get('/indicateurs/add',App\Livewire\Monitoring\Indicateurs\IndicateurAdd::class)->name('monitoring.indicateurs.add');Route::get('/indicateurs/{id}/edit',App\Livewire\Monitoring\Indicateurs\IndicateurEdit::class)->name('monitoring.indicateurs.edit');Route::get('/indicateurs/{id}/show',App\Livewire\Monitoring\Indicateurs\IndicateurShow::class)->name('monitoring.indicateurs.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/periodes',App\Livewire\Monitoring\Periodes\PeriodeListe::class)->name('monitoring.periodes');Route::get('/periodes/add',App\Livewire\Monitoring\Periodes\PeriodeAdd::class)->name('monitoring.periodes.add');Route::get('/periodes/{id}/edit',App\Livewire\Monitoring\Periodes\PeriodeEdit::class)->name('monitoring.periodes.edit');Route::get('/periodes/{id}/show',App\Livewire\Monitoring\Periodes\PeriodeShow::class)->name('monitoring.periodes.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/produits',App\Livewire\Monitoring\Produits\ProduitListe::class)->name('monitoring.produits');Route::get('/produits/add',App\Livewire\Monitoring\Produits\ProduitAdd::class)->name('monitoring.produits.add');Route::get('/produits/{id}/edit',App\Livewire\Monitoring\Produits\ProduitEdit::class)->name('monitoring.produits.edit');Route::get('/produits/{id}/show',App\Livewire\Monitoring\Produits\ProduitShow::class)->name('monitoring.produits.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/resultats',App\Livewire\Monitoring\Resultats\ResultatListe::class)->name('monitoring.resultats');Route::get('/resultats/add',App\Livewire\Monitoring\Resultats\ResultatAdd::class)->name('monitoring.resultats.add');Route::get('/resultats/{id}/edit',App\Livewire\Monitoring\Resultats\ResultatEdit::class)->name('monitoring.resultats.edit');Route::get('/resultats/{id}/show',App\Livewire\Monitoring\Resultats\ResultatShow::class)->name('monitoring.resultats.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/produits',App\Livewire\Monitoring\Produits\ProduitListe::class)->name('monitoring.produits');Route::get('/produits/add',App\Livewire\Monitoring\Produits\ProduitAdd::class)->name('monitoring.produits.add');Route::get('/produits/{id}/edit',App\Livewire\Monitoring\Produits\ProduitEdit::class)->name('monitoring.produits.edit');Route::get('/produits/{id}/show',App\Livewire\Monitoring\Produits\ProduitShow::class)->name('monitoring.produits.show');});

/*
Route::prefix('beneficiaire')->middleware('auth')->group(function(){Route::get('/groupements',App\Livewire\Beneficiaire\Groupements\GroupeneniListe::class)->name('beneficiaire.groupements');Route::get('/groupements/add',App\Livewire\Beneficiaire\Groupements\GroupeneniAdd::class)->name('beneficiaire.groupements.add');Route::get('/groupements/{id}/edit',App\Livewire\Beneficiaire\Groupements\GroupeneniEdit::class)->name('beneficiaire.groupements.edit');Route::get('/groupements/{id}/show',App\Livewire\Beneficiaire\Groupements\GroupeneniShow::class)->name('beneficiaire.groupements.show');});*/


Route::prefix('pret')->middleware('auth')->group(function(){Route::get('/credits',App\Livewire\Pret\Credits\CreditListe::class)->name('pret.credits');Route::get('/credits/add',App\Livewire\Pret\Credits\CreditAdd::class)->name('pret.credits.add');Route::get('/credits/{id}/edit',App\Livewire\Pret\Credits\CreditEdit::class)->name('pret.credits.edit');Route::get('/credits/{id}/show',App\Livewire\Pret\Credits\CreditShow::class)->name('pret.credits.show');});


Route::prefix('pret')->middleware('auth')->group(function(){Route::get('/echeances',App\Livewire\Pret\Echeances\EcheanceListe::class)->name('pret.echeances');Route::get('/echeances/add',App\Livewire\Pret\Echeances\EcheanceAdd::class)->name('pret.echeances.add');Route::get('/echeances/{id}/edit',App\Livewire\Pret\Echeances\EcheanceEdit::class)->name('pret.echeances.edit');Route::get('/echeances/{id}/show',App\Livewire\Pret\Echeances\EcheanceShow::class)->name('pret.echeances.show');});


Route::prefix('dataCollect')->middleware('auth')->group(function(){Route::get('/donnees',App\Livewire\DataCollect\Donnees\DonneeListe::class)->name('dataCollect.donnees');Route::get('/donnees/add',App\Livewire\DataCollect\Donnees\DonneeAdd::class)->name('dataCollect.donnees.add');Route::get('/donnees/{id}/edit',App\Livewire\DataCollect\Donnees\DonneeEdit::class)->name('dataCollect.donnees.edit');Route::get('/donnees/{id}/show',App\Livewire\DataCollect\Donnees\DonneeShow::class)->name('dataCollect.donnees.show');});


Route::prefix('dataCollect')->middleware('auth')->group(function(){Route::get('/donnees',App\Livewire\DataCollect\Donnees\DonneeListe::class)->name('dataCollect.donnees');Route::get('/donnees/add',App\Livewire\DataCollect\Donnees\DonneeAdd::class)->name('dataCollect.donnees.add');Route::get('/donnees/{id}/edit',App\Livewire\DataCollect\Donnees\DonneeEdit::class)->name('dataCollect.donnees.edit');Route::get('/donnees/{id}/show',App\Livewire\DataCollect\Donnees\DonneeShow::class)->name('dataCollect.donnees.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/formulaires',App\Livewire\Datacollect\Formulaires\FormulaireListe::class)->name('datacollect.formulaires');Route::get('/formulaires/add',App\Livewire\Datacollect\Formulaires\FormulaireAdd::class)->name('datacollect.formulaires.add');Route::get('/formulaires/{id}/edit',App\Livewire\Datacollect\Formulaires\FormulaireEdit::class)->name('datacollect.formulaires.edit');Route::get('/formulaires/{id}/show',App\Livewire\Datacollect\Formulaires\FormulaireShow::class)->name('datacollect.formulaires.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/lessessions',App\Livewire\Monitoring\Lessessions\LessessionListe::class)->name('monitoring.lessessions');
Route::get('/lessessions/add',App\Livewire\Monitoring\Lessessions\LessessionAdd::class)->name('monitoring.lessessions.add');
Route::get('/lessessions/{id}/edit',App\Livewire\Monitoring\Lessessions\LessessionEdit::class)->name('monitoring.lessessions.edit');
Route::get('/lessessions/{id}/show',App\Livewire\Monitoring\Lessessions\LessessionShow::class)->name('monitoring.lessessions.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/sites',App\Livewire\Projet\Sites\SiteListe::class)->name('projet.sites');Route::get('/sites/add',App\Livewire\Projet\Sites\SiteAdd::class)->name('projet.sites.add');Route::get('/sites/{id}/edit',App\Livewire\Projet\Sites\SiteEdit::class)->name('projet.sites.edit');Route::get('/sites/{id}/show',App\Livewire\Projet\Sites\SiteShow::class)->name('projet.sites.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/lessessions',App\Livewire\Monitoring\Lessessions\LessessionListe::class)->name('monitoring.lessessions');Route::get('/lessessions/add',App\Livewire\Monitoring\Lessessions\LessessionAdd::class)->name('monitoring.lessessions.add');Route::get('/lessessions/{id}/edit',App\Livewire\Monitoring\Lessessions\LessessionEdit::class)->name('monitoring.lessessions.edit');Route::get('/lessessions/{id}/show',App\Livewire\Monitoring\Lessessions\LessessionShow::class)->name('monitoring.lessessions.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/lessessions',App\Livewire\Datacollect\Lessessions\LessessionListe::class)->name('datacollect.lessessions');Route::get('/lessessions/add',App\Livewire\Datacollect\Lessessions\LessessionAdd::class)->name('datacollect.lessessions.add');Route::get('/lessessions/{id}/edit',App\Livewire\Datacollect\Lessessions\LessessionEdit::class)->name('datacollect.lessessions.edit');Route::get('/lessessions/{id}/show',App\Livewire\Datacollect\Lessessions\LessessionShow::class)->name('datacollect.lessessions.show');});


Route::prefix('assitance')->middleware('auth')->group(function(){Route::get('/issues',App\Livewire\Assitance\Issues\IssueListe::class)->name('assitance.issues');Route::get('/issues/add',App\Livewire\Assitance\Issues\IssueAdd::class)->name('assitance.issues.add');Route::get('/issues/{id}/edit',App\Livewire\Assitance\Issues\IssueEdit::class)->name('assitance.issues.edit');Route::get('/issues/{id}/show',App\Livewire\Assitance\Issues\IssueShow::class)->name('assitance.issues.show');});


Route::prefix('assistance')->middleware('auth')->group(function(){Route::get('/issues',App\Livewire\Assistance\Issues\IssueListe::class)->name('assistance.issues');Route::get('/issues/add',App\Livewire\Assistance\Issues\IssueAdd::class)->name('assistance.issues.add');Route::get('/issues/{id}/edit',App\Livewire\Assistance\Issues\IssueEdit::class)->name('assistance.issues.edit');Route::get('/issues/{id}/show',App\Livewire\Assistance\Issues\IssueShow::class)->name('assistance.issues.show');});


Route::prefix('assistance')->middleware('auth')->group(function(){Route::get('/issues',App\Livewire\Assistance\Issues\IssueListe::class)->name('assistance.issues');Route::get('/issues/add',App\Livewire\Assistance\Issues\IssueAdd::class)->name('assistance.issues.add');Route::get('/issues/{id}/edit',App\Livewire\Assistance\Issues\IssueEdit::class)->name('assistance.issues.edit');Route::get('/issues/{id}/show',App\Livewire\Assistance\Issues\IssueShow::class)->name('assistance.issues.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/typesessions',App\Livewire\Projet\Typesessions\TypesessionListe::class)->name('projet.typesessions');Route::get('/typesessions/add',App\Livewire\Projet\Typesessions\TypesessionAdd::class)->name('projet.typesessions.add');Route::get('/typesessions/{id}/edit',App\Livewire\Projet\Typesessions\TypesessionEdit::class)->name('projet.typesessions.edit');Route::get('/typesessions/{id}/show',App\Livewire\Projet\Typesessions\TypesessionShow::class)->name('projet.typesessions.show');});


Route::prefix('etude')->middleware('auth')->group(function(){Route::get('/etudes',App\Livewire\Etude\Etudes\EtudeListe::class)->name('etude.etudes');Route::get('/etudes/add',App\Livewire\Etude\Etudes\EtudeAdd::class)->name('etude.etudes.add');Route::get('/etudes/{id}/edit',App\Livewire\Etude\Etudes\EtudeEdit::class)->name('etude.etudes.edit');Route::get('/etudes/{id}/show',App\Livewire\Etude\Etudes\EtudeShow::class)->name('etude.etudes.show');});


Route::prefix('etude')->middleware('auth')->group(function(){Route::get('/etudes',App\Livewire\Etude\Etudes\EtudeListe::class)->name('etude.etudes');Route::get('/etudes/add',App\Livewire\Etude\Etudes\EtudeAdd::class)->name('etude.etudes.add');Route::get('/etudes/{id}/edit',App\Livewire\Etude\Etudes\EtudeEdit::class)->name('etude.etudes.edit');Route::get('/etudes/{id}/show',App\Livewire\Etude\Etudes\EtudeShow::class)->name('etude.etudes.show');});


Route::prefix('etude')->middleware('auth')->group(function(){Route::get('/etudes',App\Livewire\Etude\Etudes\EtudeListe::class)->name('etude.etudes');Route::get('/etudes/add',App\Livewire\Etude\Etudes\EtudeAdd::class)->name('etude.etudes.add');Route::get('/etudes/{id}/edit',App\Livewire\Etude\Etudes\EtudeEdit::class)->name('etude.etudes.edit');Route::get('/etudes/{id}/show',App\Livewire\Etude\Etudes\EtudeShow::class)->name('etude.etudes.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/documents',App\Livewire\Projet\Documents\DocumentListe::class)->name('projet.documents');Route::get('/documents/add',App\Livewire\Projet\Documents\DocumentAdd::class)->name('projet.documents.add');Route::get('/documents/{id}/edit',App\Livewire\Projet\Documents\DocumentEdit::class)->name('projet.documents.edit');Route::get('/documents/{id}/show',App\Livewire\Projet\Documents\DocumentShow::class)->name('projet.documents.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/albums',App\Livewire\Projet\Albums\AlbumListe::class)->name('projet.albums');Route::get('/albums/add',App\Livewire\Projet\Albums\AlbumAdd::class)->name('projet.albums.add');Route::get('/albums/{id}/edit',App\Livewire\Projet\Albums\AlbumEdit::class)->name('projet.albums.edit');Route::get('/albums/{id}/show',App\Livewire\Projet\Albums\AlbumShow::class)->name('projet.albums.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/albums',App\Livewire\Projet\Albums\AlbumListe::class)->name('projet.albums');Route::get('/albums/add',App\Livewire\Projet\Albums\AlbumAdd::class)->name('projet.albums.add');Route::get('/albums/{id}/edit',App\Livewire\Projet\Albums\AlbumEdit::class)->name('projet.albums.edit');Route::get('/albums/{id}/show',App\Livewire\Projet\Albums\AlbumShow::class)->name('projet.albums.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/documents',App\Livewire\Projet\Documents\DocumentListe::class)->name('projet.documents');Route::get('/documents/add',App\Livewire\Projet\Documents\DocumentAdd::class)->name('projet.documents.add');Route::get('/documents/{id}/edit',App\Livewire\Projet\Documents\DocumentEdit::class)->name('projet.documents.edit');Route::get('/documents/{id}/show',App\Livewire\Projet\Documents\DocumentShow::class)->name('projet.documents.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/albums',App\Livewire\Projet\Albums\AlbumListe::class)->name('projet.albums');Route::get('/albums/add',App\Livewire\Projet\Albums\AlbumAdd::class)->name('projet.albums.add');Route::get('/albums/{id}/edit',App\Livewire\Projet\Albums\AlbumEdit::class)->name('projet.albums.edit');Route::get('/albums/{id}/show',App\Livewire\Projet\Albums\AlbumShow::class)->name('projet.albums.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/etudes',App\Livewire\Monitoring\Etudes\EtudeListe::class)->name('monitoring.etudes');Route::get('/etudes/add',App\Livewire\Monitoring\Etudes\EtudeAdd::class)->name('monitoring.etudes.add');Route::get('/etudes/{id}/edit',App\Livewire\Monitoring\Etudes\EtudeEdit::class)->name('monitoring.etudes.edit');Route::get('/etudes/{id}/show',App\Livewire\Monitoring\Etudes\EtudeShow::class)->name('monitoring.etudes.show');});


Route::prefix('datacollect')->middleware('auth')->group(function(){Route::get('/groupements',App\Livewire\Datacollect\Groupements\GroupementListe::class)->name('datacollect.groupements');Route::get('/groupements/add',App\Livewire\Datacollect\Groupements\GroupementAdd::class)->name('datacollect.groupements.add');
Route::get('/groupements/{id}/edit',App\Livewire\Datacollect\Groupements\GroupementEdit::class)->name('datacollect.groupements.edit');
Route::get('/groupements/{id}/show',App\Livewire\Datacollect\Groupements\GroupementShow::class)->name('datacollect.groupements.show');
Route::get('/groupements/{id}/addmembres',App\Livewire\Datacollect\Groupements\GroupementAddMembres::class)->name('datacollect.groupements.addmembres');
      
});


Route::prefix('reporting')->middleware('auth')->group(
function(){
    Route::get('/',function(){
        return view('livewire..reporting.index');
    });
    Route::get('/documents',App\Livewire\Reporting\Documents\DocumentListe::class)->name('reporting.documents');Route::get('/documents/add',App\Livewire\Reporting\Documents\DocumentAdd::class)->name('reporting.documents.add');Route::get('/documents/{id}/edit',App\Livewire\Reporting\Documents\DocumentEdit::class)->name('reporting.documents.edit');Route::get('/documents/{id}/show',App\Livewire\Reporting\Documents\DocumentShow::class)->name('reporting.documents.show');});


Route::prefix('reporting')->middleware('auth')->group(function(){Route::get('/albums',App\Livewire\Reporting\Albums\AlbumListe::class)->name('reporting.albums');Route::get('/albums/add',App\Livewire\Reporting\Albums\AlbumAdd::class)->name('reporting.albums.add');Route::get('/albums/{id}/edit',App\Livewire\Reporting\Albums\AlbumEdit::class)->name('reporting.albums.edit');Route::get('/albums/{id}/show',App\Livewire\Reporting\Albums\AlbumShow::class)->name('reporting.albums.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/indicateurs',App\Livewire\Projet\Indicateurs\IndicateurListe::class)->name('projet.indicateurs');Route::get('/indicateurs/add',App\Livewire\Projet\Indicateurs\IndicateurAdd::class)->name('projet.indicateurs.add');Route::get('/indicateurs/{id}/edit',App\Livewire\Projet\Indicateurs\IndicateurEdit::class)->name('projet.indicateurs.edit');Route::get('/indicateurs/{id}/show',App\Livewire\Projet\Indicateurs\IndicateurShow::class)->name('projet.indicateurs.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/indicateurs',App\Livewire\Projet\Indicateurs\IndicateurListe::class)->name('projet.indicateurs');Route::get('/indicateurs/add',App\Livewire\Projet\Indicateurs\IndicateurAdd::class)->name('projet.indicateurs.add');Route::get('/indicateurs/{id}/edit',App\Livewire\Projet\Indicateurs\IndicateurEdit::class)->name('projet.indicateurs.edit');Route::get('/indicateurs/{id}/show',App\Livewire\Projet\Indicateurs\IndicateurShow::class)->name('projet.indicateurs.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/odds',App\Livewire\Projet\Odds\OddListe::class)->name('projet.odds');Route::get('/odds/add',App\Livewire\Projet\Odds\OddAdd::class)->name('projet.odds.add');Route::get('/odds/{id}/edit',App\Livewire\Projet\Odds\OddEdit::class)->name('projet.odds.edit');Route::get('/odds/{id}/show',App\Livewire\Projet\Odds\OddShow::class)->name('projet.odds.show');});

