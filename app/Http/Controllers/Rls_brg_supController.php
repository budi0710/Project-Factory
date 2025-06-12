<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rls_brg_sup;
use App\Models\ViewRelasiBarangSupplier;
use Illuminate\Support\Facades\Redis;

class Rls_brg_supController extends Controller
{
    public function load(){
        return ViewRelasiBarangSupplier::paginate(10);
    }

    public function loadData(){
        return ViewRelasiBarangSupplier::all();
    }

    public function loadDataWhere(Request $request){
        return Rls_brg_sup::where('kode_supplier', $request->kode_supplier)->get();
    }

    public function generateId(){
       $result  = Rls_brg_sup::select('kode_rls')
                        ->orderBy('kode_rls','desc')
                        ->first();

       if ($result==null){
        return 'RLS-001';
       }else{
        return $result;
       }
    }

    public function save(Request $request){
        $Rls_brg_sup = new Rls_brg_sup();

        $Rls_brg_sup->kode_supplier = $request->kode_supplier;
        $Rls_brg_sup->id_otomatis = $request->id_otomatis;
        $Rls_brg_sup->kode_rls = $request->kode_rls;
        $Rls_brg_sup->nama_brg_sup = $request->nama_brg_sup;
        $Rls_brg_sup->kode_part = $request->kode_part;
        $Rls_brg_sup->harga_beli = $request->harga_beli;
        $Rls_brg_sup->satuan_beli = $request->satuan_beli;
        $Rls_brg_sup->foto = 'no-image.png';
        return $Rls_brg_sup->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function update(Request $request){
        $Rls_brg_sup = Rls_brg_sup::find($request->id);

        $Rls_brg_sup->nama_brg_sup = $request->nama_brg_sup;
        $Rls_brg_sup->harga_beli = $request->harga_beli;
        $Rls_brg_sup->satuan_beli = $request->satuan_beli;
        $Rls_brg_sup->kode_part = $request->kode_part;
        return $Rls_brg_sup->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function delete(Request $request){
        $Rls_brg_sup = Rls_brg_sup::find($request->id);

       return $Rls_brg_sup->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function search(Request $request){
        $ViewRelasiBarangSupplier = ViewRelasiBarangSupplier::where('nama_brg_sup','like','%'.$request->search.'%')->get();

        return ($ViewRelasiBarangSupplier);
    }

    public function searchData(Request $request){
        $data = Rls_brg_sup::where('kode_supplier', $request->kode_supplier)
                            ->where('nama_brg_sup','like','%'.$request->search.'%')
                            ->get();
      
        return ($data);
    }
}
