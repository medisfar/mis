<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/imp', function(){
$row = 1;
if (($handle = fopen(public_path()."/prefet.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        
        \App\Models\Prefecture::create([
         'nom_prefecture'=>$data[2],
         'region_id'=>$data[3] - 10,
         'code'=>$data[0],
          'l_type'=>$data[1]=='Commune'?0:1]
        );
    }

    fclose($handle);
}
});
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
    return Route::get('/gp/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/gp/livewire/update', $handle);
});

Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/regions',App\Livewire\Geolocalisation\Regions\RegionListe::class)->name('geolocalisation.regions');Route::get('/regions/add',App\Livewire\Geolocalisation\Regions\RegionAdd::class)->name('geolocalisation.regions.add');Route::get('/regions/{id}/edit',App\Livewire\Geolocalisation\Regions\RegionEdit::class)->name('geolocalisation.regions.edit');Route::get('/regions/{id}/show',App\Livewire\Geolocalisation\Regions\RegionShow::class)->name('geolocalisation.regions.show');});







Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/localites',App\Livewire\Geolocalisation\Localites\LocaliteListe::class)->name('geolocalisation.localites');Route::get('/localites/add',App\Livewire\Geolocalisation\Localites\LocaliteAdd::class)->name('geolocalisation.localites.add');Route::get('/localites/{id}/edit',App\Livewire\Geolocalisation\Localites\LocaliteEdit::class)->name('geolocalisation.localites.edit');Route::get('/localites/{id}/show',App\Livewire\Geolocalisation\Localites\LocaliteShow::class)->name('geolocalisation.localites.show');});


Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/zones',App\Livewire\Geolocalisation\Zones\ZoneListe::class)->name('geolocalisation.zones');Route::get('/zones/add',App\Livewire\Geolocalisation\Zones\ZoneAdd::class)->name('geolocalisation.zones.add');Route::get('/zones/{id}/edit',App\Livewire\Geolocalisation\Zones\ZoneEdit::class)->name('geolocalisation.zones.edit');Route::get('/zones/{id}/show',App\Livewire\Geolocalisation\Zones\ZoneShow::class)->name('geolocalisation.zones.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/projets',App\Livewire\Projet\Projets\ProjetListe::class)->name('projet.projets');Route::get('/projets/add',App\Livewire\Projet\Projets\ProjetAdd::class)->name('projet.projets.add');Route::get('/projets/{id}/edit',App\Livewire\Projet\Projets\ProjetEdit::class)->name('projet.projets.edit');Route::get('/projets/{id}/show',App\Livewire\Projet\Projets\ProjetShow::class)->name('projet.projets.show');});


Route::prefix('projets')->middleware('auth')->group(function(){Route::get('/projet/activites',App\Livewire\Projet\Activites\ActiviteListe::class)->name('projets.projet.activites');Route::get('/projet/activites/add',App\Livewire\Projet\Activites\ActiviteAdd::class)->name('projets.projet.activites.add');Route::get('/projet/{ide}/activites/{id}/edit',App\Livewire\Projet\Activites\ActiviteEdit::class)->name('projets.projet.activites.edit');Route::get('/projet/{ide}/activites/{id}/show',App\Livewire\Projet\Activites\ActiviteShow::class)->name('projets.projet.activites.show');});



Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/composantes',App\Livewire\Projet\Composantes\ComposanteListe::class)->name('projet.composantes');

    Route::get('/composantes/add/{pid}',App\Livewire\Projet\Composantes\ComposanteAdd::class)->name('projet.composantes.add');
    Route::get('/composantes/{id}/edit',App\Livewire\Projet\Composantes\ComposanteEdit::class)->name('projet.composantes.edit');
    Route::get('/composantes/{id}/show',App\Livewire\Projet\Composantes\ComposanteShow::class)->name('projet.composantes.show');});


Route::prefix('projet')->middleware('auth')->group(function(){
    Route::get('/souscomposantes',App\Livewire\Projet\Souscomposantes\SouscomposanteListe::class)->name('projet.souscomposantes');
    Route::get('/souscomposantes/add/{idr}',App\Livewire\Projet\Souscomposantes\SouscomposanteAdd::class)->name('projet.souscomposantes.add');
    Route::get('/souscomposantes/{id}/edit',App\Livewire\Projet\Souscomposantes\SouscomposanteEdit::class)->name('projet.souscomposantes.edit');
    Route::get('/souscomposantes/{id}/show',App\Livewire\Projet\Souscomposantes\SouscomposanteShow::class)->name('projet.souscomposantes.show');});


Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/ssprefectures',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureListe::class)->name('geolocalisation.ssprefectures');Route::get('/ssprefectures/add',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureAdd::class)->name('geolocalisation.ssprefectures.add');Route::get('/ssprefectures/{id}/edit',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureEdit::class)->name('geolocalisation.ssprefectures.edit');Route::get('/ssprefectures/{id}/show',App\Livewire\Geolocalisation\Ssprefectures\SsprefectureShow::class)->name('geolocalisation.ssprefectures.show');});




Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/prefectures',App\Livewire\Geolocalisation\Prefectures\PrefectureListe::class)->name('geolocalisation.prefectures');Route::get('/prefectures/add',App\Livewire\Geolocalisation\Prefectures\PrefectureAdd::class)->name('geolocalisation.prefectures.add');Route::get('/prefectures/{id}/edit',App\Livewire\Geolocalisation\Prefectures\PrefectureEdit::class)->name('geolocalisation.prefectures.edit');Route::get('/prefectures/{id}/show',App\Livewire\Geolocalisation\Prefectures\PrefectureShow::class)->name('geolocalisation.prefectures.show');});

Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/composantes',App\Livewire\Projet\Composantes\composanteListe::class)->name('projet.composantes');Route::get('/composantes/add',App\Livewire\Projet\Composantes\composanteAdd::class)->name('projet.composantes.add');Route::get('/composantes/{id}/edit',App\Livewire\Projet\Composantes\composanteEdit::class)->name('projet.composantes.edit');Route::get('/composantes/{id}/show',App\Livewire\Projet\Composantes\composanteShow::class)->name('projet.composantes.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/souscomposantes',App\Livewire\Projet\Souscomposantes\SouscomposanteListe::class)->name('projet.souscomposantes');Route::get('/souscomposantes/add',App\Livewire\Projet\Souscomposantes\SouscomposanteAdd::class)->name('projet.souscomposantes.add');Route::get('/souscomposantes/{id}/edit',App\Livewire\Projet\Souscomposantes\SouscomposanteEdit::class)->name('projet.souscomposantes.edit');Route::get('/souscomposantes/{id}/show',App\Livewire\Projet\Souscomposantes\SouscomposanteShow::class)->name('projet.souscomposantes.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/activites',App\Livewire\Projet\Activites\ActiviteListe::class)->name('projet.activites');Route::get('/activites/add',App\Livewire\Projet\Activites\ActiviteAdd::class)->name('projet.activites.add');Route::get('/activites/{id}/edit',App\Livewire\Projet\Activites\ActiviteEdit::class)->name('projet.activites.edit');Route::get('/activites/{id}/show',App\Livewire\Projet\Activites\ActiviteShow::class)->name('projet.activites.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/activites',App\Livewire\Projet\Activites\ActiviteListe::class)->name('projet.activites');Route::get('/activites/add',App\Livewire\Projet\Activites\ActiviteAdd::class)->name('projet.activites.add');Route::get('/activites/{id}/edit',App\Livewire\Projet\Activites\ActiviteEdit::class)->name('projet.activites.edit');Route::get('/activites/{id}/show',App\Livewire\Projet\Activites\ActiviteShow::class)->name('projet.activites.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/activites',App\Livewire\Projet\Activites\ActiviteListe::class)->name('projet.activites');Route::get('/activites/add',App\Livewire\Projet\Activites\ActiviteAdd::class)->name('projet.activites.add');Route::get('/activites/{id}/edit',App\Livewire\Projet\Activites\ActiviteEdit::class)->name('projet.activites.edit');Route::get('/activites/{id}/show',App\Livewire\Projet\Activites\ActiviteShow::class)->name('projet.activites.show');});


Route::prefix('geolocalisation')->middleware('auth')->group(function(){Route::get('/regions',App\Livewire\Geolocalisation\Regions\RegionListe::class)->name('geolocalisation.regions');Route::get('/regions/add',App\Livewire\Geolocalisation\Regions\RegionAdd::class)->name('geolocalisation.regions.add');Route::get('/regions/{id}/edit',App\Livewire\Geolocalisation\Regions\RegionEdit::class)->name('geolocalisation.regions.edit');Route::get('/regions/{id}/show',App\Livewire\Geolocalisation\Regions\RegionShow::class)->name('geolocalisation.regions.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/taches',App\Livewire\Projet\Taches\TacheListe::class)->name('projet.taches');Route::get('/taches/add',App\Livewire\Projet\Taches\TacheAdd::class)->name('projet.taches.add');Route::get('/taches/{id}/edit',App\Livewire\Projet\Taches\TacheEdit::class)->name('projet.taches.edit');Route::get('/taches/{id}/show',App\Livewire\Projet\Taches\TacheShow::class)->name('projet.taches.show');});


Route::prefix('projet')->middleware('auth')->group(function(){Route::get('/bailleurs',App\Livewire\Projet\Bailleurs\BailleurListe::class)->name('projet.bailleurs');Route::get('/bailleurs/add',App\Livewire\Projet\Bailleurs\BailleurAdd::class)->name('projet.bailleurs.add');Route::get('/bailleurs/{id}/edit',App\Livewire\Projet\Bailleurs\BailleurEdit::class)->name('projet.bailleurs.edit');Route::get('/bailleurs/{id}/show',App\Livewire\Projet\Bailleurs\BailleurShow::class)->name('projet.bailleurs.show');});


Route::prefix('monitoring')->middleware('auth')->group(function(){Route::get('/missions',App\Livewire\Monitoring\Missions\MissionListe::class)->name('monitoring.missions');Route::get('/missions/add',App\Livewire\Monitoring\Missions\MissionAdd::class)->name('monitoring.missions.add');Route::get('/missions/{id}/edit',App\Livewire\Monitoring\Missions\MissionEdit::class)->name('monitoring.missions.edit');Route::get('/missions/{id}/show',App\Livewire\Monitoring\Missions\MissionShow::class)->name('monitoring.missions.show');});

