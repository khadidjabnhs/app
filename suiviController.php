<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Validator;
use Response;
use App\equipe;
use App\tache;
use View;

class suivicontroller extends Controller
{
    public function index()
    {
        $equipesWithNoTaches = tache::where('equipe_id', null)->get();
        $taches= tache::all();
        $equipes = equipe::with('taches')->paginate(20);
        
        //return equipe::with('taches')->get();
        return view('suivi', compact('equipes','taches', 'equipesWithNoTaches'));
       
      //return view('test',compact('equipe'));
    }
}
