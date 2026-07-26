<?php


namespace App\Http\Controllers\Api;

use App\Models\Groupe;
use App\Models\Formation;
use App\Models\Individu;
use App\Models\FormationGroupe;
use App\Models\GroupeIndividu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
   
    public function index()
    {
      
    return [
        'formation'=>Formation::all(),
        'groupe'=>Groupe::all(),
        'individu'=>Individu::all(),
        'groupeIndividu'=>GroupeIndividu::all(),
        'formationGroupe'=>FormationGroupe::all()
    ];
    }
}