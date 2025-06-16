<?php

namespace App\Http\Controllers;
use App\Models\l_d_poc;
use Illuminate\Http\Request;

class DetailPocController extends Controller
{
        public function loadWhere(Request $request){
        return l_d_poc::where('fno_poc',$request->fno_poc)->get();
    }
}
