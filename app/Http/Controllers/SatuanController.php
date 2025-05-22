<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function load(){
        return Satuan::paginate(10);
    }

    public function save(Request $request){
        $satuan = new Satuan();

        $satuan->satuan = $request->satuan;

        return $satuan->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function update(Request $request){
         $satuan = Satuan::find($request->id);

        $satuan->satuan = $request->satuan;

        return $satuan->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function delete(Request $request){
        $Satuan = Satuan::find($request->id);

       return $Satuan->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }
}
