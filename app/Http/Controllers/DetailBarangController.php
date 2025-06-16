<?php

namespace App\Http\Controllers;

use App\Models\L_d_pos;
use App\Models\tb_d_pos;
use Illuminate\Http\Request;

class DetailBarangController extends Controller
{
        public function loadWhere(Request $request){
        return L_d_pos::where('fno_pos',$request->fno_pos)->get();
    }

    public function delete(Request $request){
        $tbdpos = tb_d_pos::where('fk_rls',$request->kd_rls)->delete();
        

        return L_d_pos::where('fno_pos',$request->fno_pos)->get();
    }
}
