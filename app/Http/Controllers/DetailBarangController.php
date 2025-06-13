<?php

namespace App\Http\Controllers;

use App\Models\L_d_pos;
use Illuminate\Http\Request;

class DetailBarangController extends Controller
{
    public function loadWhere(Request $request){
        return L_d_pos::where('fno_pos',$request->fno_pos)->get();
    }
}
