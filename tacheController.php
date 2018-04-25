<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tache;
use App\equipe;

class tachecontroller extends Controller
{
    public function homet(){
      $taches = Tache::all();
      $equipes = equipe::all();
      
     return view('planing',['taches' => $taches],['equipes' => $equipes]);
     } 
    
    
    
     public function index()
    {
       
          $equipes = equipe::all();
         $taches = Tache::whereNotNull('equipe_id')->paginate(10);
         $taches_noeq = Tache::whereNull('equipe_id')->paginate(10);
        return view('affichertache', ['equipes' => $equipes,'taches' => $taches,'taches_noeq'=>$taches_noeq]);
       
      //return view('test',compact('equipe'));
    }

    public function changeStatus($id,Request $request)
    {
        Tache::where('id',$id)->update(['equipe_id'=>$request->equipe_id]);

        return redirect('affichertache')->with('info',' la Tache a été ajouté avec succée' );
    }
    
    
    
      public function show($id)
    {
        $tache = Tache::findOrFail($id);

        return view('tache.show', ['tache' => $tache]);
    }
      public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();

        return response()->json($tache);
    }

    
    
     public function readt ($id){
    $taches = Tache::find($id);
         $user = User::find(1);
    $user->notify(new MyNotif());
    return view('planing', ['taches'=> $taches]);
    }
    
    public function deleteItem(Request $request) {
        //echo "123";exit;
        $input  = $request->all();
        $itemId = $input['itemId'];
        $tache  = Tache::findOrFail($itemId);
        $tache->delete();
        return 1;
    }
   
 public function addt(Request $request){
      $taches = $request->except('_token');
      $taches['address'] =$request ->input('title');
      unset($taches['title']);
     // ;$taches['equipe_id'] =$request ->input('equipe_id');
     //;$taches['priorite'] =$request ->input('priorite');
    // $taches['duree'] =$request ->input('duree');

     Tache::create($taches);
    
     return redirect ('/planing')  -> with('info',' la Tache a été ajouté avec succée' );
 }
     public function deletet($id){
        tache::where('id',$id)
        ->delete();
       return redirect ('/planing')  -> with('info',' la tache a été supprimé avec succée' );
    }

public function affecter()
{
    $taches = equipe::find(4)->tache;
    return view('TT', compact('taches'));
}
    
}
