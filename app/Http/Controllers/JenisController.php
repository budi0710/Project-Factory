<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function load(){
        return Jenis::paginate(5);
    }

    public function loadData(){
        return Jenis::all();
    }

    public function save(Request $request){
        $Jenis = new Jenis();

        $Jenis->jenis = $request->jenis;

        return $Jenis->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function update(Request $request){
         $Jenis = Jenis::find($request->id);

        $Jenis->jenis = $request->jenis;

        return $Jenis->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function delete(Request $request){
        $Jenis = Jenis::find($request->id);
       return $Jenis->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

     public function search(Request $request){
        return Jenis::where('jenis','like','%'.$request->search.'%')->get();
       
    }
}
