<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\equipe;
use App\tache;
use View;



class testController extends Controller
{
    protected $rules =
    [
        'nom' => 'required|min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
        'chef' => 'required|min:2|max:128|regex:/^[a-z ,.\'-]+$/i'
    ];

    public function index()
    {
        $equipesWithNoTaches = tache::where('equipe_id', null)->get();
        $taches= tache::all();
        $equipes = equipe::with('taches')->paginate(4);
        
        //return equipe::with('taches')->get();
        return view('test', compact('equipes','taches', 'equipesWithNoTaches'));
       
      //return view('test',compact('equipe'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $equipe = new equipe();
             $equipe->nom = $request->nom;
             $equipe->chef = $request->chef;
             $equipe->description = $request->description;
             $equipe->save();
            return response()->json($equipe);
        }
    }

    public function show($id)
    {
        $equipe = equipe::findOrFail($id);

        return view('equipe.show', ['equipe' => $equipe]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $equipe = equipe::findOrFail($id);
            $equipe->nom = $request->nom;
             $equipe->chef = $request->chef;
             $equipe->description = $request->description;
             $equipe->save();
            return response()->json($equipe);
        }
    }

    public function destroy($id)
    {
        $equipe = equipe::findOrFail($id);
        $equipe->delete();

        return response()->json($equipe);
    }

   
}
