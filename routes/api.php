<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/groupes/{id}',function($id=null){
    $data=[];
$groupes= \App\Models\Groupement::find($id)->membres;
foreach($groupes as $g)
$data[]=['id'=>''.$g['id'],'nom'=>$g['nom'],'date_naissance'=>$g['date_naissance']];
return $data;
});

Route::get('/allforms/{id}',function($id=null){
 if($id==null) $ps=  \App\Models\Formulaire::all();  
else $ps=  \App\Models\Formulaire::where('projet_id',$id)->get();  
$data=[];
foreach($ps as $p){

$d=array_merge($p->toArray(), ['id' => '' . $p->id]);
 $data[]=$d;
}
 return $data;
});

Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'loginUser']);
Route::get('/allprojets', function() {
    $data = [];
    
    $rows = DB::table('projets as pj')
        ->join('composantes as cp', 'pj.id', '=', 'cp.projet_id')
        ->join('activites as ac', 'cp.id', '=', 'ac.composante_id')
        ->join('activite_site as acs', 'ac.id', '=', 'acs.activite_id')
        ->join('sites as s', 'acs.site_id', '=', 's.id')
        ->join('groupements as g', 'g.site_id', '=', 's.id')
        ->select(
            'pj.id as pjid', 
            'pj.libelle as pjnom', 
            's.id as sid', 
            's.nom as snom', 
            'g.id as gid', 
            'g.nom_groupe as gnom'
        )
        ->get()
        ->map(function($item) {
            return (array) $item;
        })
        ->toArray();
    
    foreach($rows as $p) {
        // Initialize projet
        if (!isset($data[$p['pjid']])) {
            $data[$p['pjid']] = [
                'nom' => $p['pjnom'],
                'sites' => []
            ];
        }
        
        // Initialize site
        if (!isset($data[$p['pjid']]['sites'][$p['sid']])) {
            $data[$p['pjid']]['sites'][$p['sid']] = [
                'nom' => $p['snom'],
                'groupes' => []
            ];
        }
        
        // Add groupe to site
        $data[$p['pjid']]['sites'][$p['sid']]['groupes'][$p['gid']] = $p['gnom'];
    }
    
    return $data;
});


Route::post('/submitform', function(Request $req) {
    $data = [];
 file_put_contents(public_path().'/data.txt', json_encode($req->all()));
 return ['isSuccess' => false];
});
