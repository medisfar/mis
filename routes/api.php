<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;
use App\Models\Echeance;
use App\Models\Paiement;

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

// Mobile credit synchronization. Credits include their installments and the
// optional payment so the device has everything required while offline.
Route::get('/credits', function () {
    return Credit::with(['echeances.paiement'])
        ->orderByDesc('id')
        ->get();
});

Route::get('/credit-hierarchy', function (Request $request) {
    $query = \App\Models\Site::query()
        ->select(['id', 'nom'])
        ->with([
            'groupements:id,site_id,nom_groupe',
            'groupements.membres:id,nom,date_naissance',
        ])
        ->orderBy('nom');

    if ($user = $request->user('sanctum')) {
        $query->whereHas('users', fn ($sites) => $sites->where('users.id', $user->id));
    }

    return $query->get();
});

Route::get('/paiements', function () {
    return Paiement::orderBy('id')->get();
});

Route::get('/paiements/echeance/{echeance}', function (Echeance $echeance) {
    return Paiement::where('echeance_id', $echeance->id)->get();
});

// One installment accepts one payment. Returning an existing payment makes
// mobile retries safe when a response was lost after the server committed it.
Route::post('/paiements', function (Request $request) {
    $data = $request->validate([
        'credit_id' => ['required', 'integer', 'exists:credits,id'],
        'echeance_id' => ['required', 'integer', 'exists:echeances,id'],
        'date_paiement' => ['required', 'date'],
        'montant_paye' => ['required', 'integer', 'min:1'],
    ]);

    [$paiement, $created] = DB::transaction(function () use ($data) {
        $echeance = Echeance::where('credit_id', $data['credit_id'])
            ->lockForUpdate()
            ->findOrFail($data['echeance_id']);

        $existing = Paiement::where('echeance_id', $echeance->id)->first();
        if ($existing) {
            return [$existing, false];
        }

        abort_if(
            $data['montant_paye'] > $echeance->montant_paye,
            422,
            'Le montant dépasse le montant de l’échéance.'
        );

        $paiement = Paiement::create([
            ...$data,
            'montant_restant' => max(
                0,
                $echeance->montant_paye - $data['montant_paye']
            ),
        ]);

        $credit = Credit::findOrFail($data['credit_id']);
        $credit->update([
            'termine' => $credit->echeances()
                ->whereDoesntHave('paiement')
                ->doesntExist() ? 1 : 0,
        ]);

        return [$paiement, true];
    });

    return response()->json($paiement, $created ? 201 : 200);
});

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
