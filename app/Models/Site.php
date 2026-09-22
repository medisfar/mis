<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Site extends Model
{
    	public $guarded=['id'];

	public static function tab(){
	return Site::pluck('nom','id')->prepend('','');
}
    public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_sites',
            'site_id',
            'user_id'
        )->withTimestamps();
    }
    public function localite() {
	 return $this->belongsTo('\App\Models\Localite');
    }
    public function taches() {
	 return $this->hasMany('\App\Models\Tache');
    }

    public function activites() {
	 return $this->belongsToMany('\App\Models\Activite')->withPivot('budget');
    }
 
    public function groupements() {
	 return $this->hasMany('\App\Models\Groupement');
    }
    public function localites() {
        return $this->belongsToMany('\App\Models\Localite', 'site_localite');
    }
    public function getBudgetAttribute(){
        $s=0;
        foreach($this->taches as $t)
          $s+=$t->budget;
          return $s;
    }
    
    public function actBudget($aid){
        $s=0;
        foreach(\App\Models\Tache::whereRaw('activite_id=? and site_id=?',[$aid,$this->id])->get() as $t)
          $s+=$t->budget;
          return $s;
    }
    
    
     public static  function membres($localite) {
	 $s=0;
	 if($localite==0)
	 foreach(\App\Models\Groupement::all() as $g)
	  $s+=$g->membres->count();
	  else
	 
	  foreach(\App\Models\Site::where('localite_id',$localite)->get() as $g)
	   foreach($g->groupements as $m)
	  $s+=$m->membres->count();
	 return $s;
     }
     
         public static  function foyers($localite) {
	 $s=0;
	 if($localite==0)
	 return \App\Models\Groupement::count();
	  
	  else
	  foreach(\App\Models\Site::where('localite_id',$localite)->get() as $k)
	  $s+=$k->groupements->count();
	 return $s;
     }
      public function getEngageAttribute(){
        $s=0;
        foreach($this->taches as $d)
           $s+=$d->engage;
        return $s;   
    
    }
    
      public function actEngage($aid){
        $s=0;
         foreach(\App\Models\Tache::whereRaw('activite_id=? and site_id=?',[$aid,$this->id])->get() as $t)
           $s+=$t->engage;
        return $s;   
    
    }
    
      
     
     public function getCompletedAttribute(){
        $s=0;$n=0;
        foreach($this->taches as $d){
           $s+=$d->engage; $this->n++;}
        return $s/$n;   
    
    }
    public function decomptes() {
	 return $this->hasMany('\App\Models\Decompte');
    }
    public function getDecaisseAttribute(){
        $s=0;
        foreach($this->decomptes as $d)
           $s+=$d->montant;
        return $s;   
    
    }
     public function actDecaisse($aid){
        $s=0;
         foreach(\App\Models\Decompte::whereRaw('activite_id=? and site_id=?',[$aid,$this->id])->get() as $d)
           $s+=$d->montant;
        return $s;   
    
    }
}
