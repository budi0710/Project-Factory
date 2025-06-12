<?php

namespace App\Http\Controllers;
use App\Models\Rls_brg_Cus;
use App\Models\ViewRelasiBarangCustomer;
use Illuminate\Http\Request;

class Rls_Brg_CusController extends Controller
{
    public function load(){
        return ViewRelasiBarangCustomer::paginate(10);
    }

    public function loadData(){
        return ViewRelasiBarangCustomer::all();
    }

    public function loadDataWhere(Request $request){
        return Rls_brg_Cus::where('kode_cus', $request->kode_cus)->get();
    }

    public function generateNewId_rls_RBC(){
       $result  = Rls_brg_Cus::select('kode_rbc')
                        ->orderBy('kode_rbc','desc')
                        ->first();

       if ($result==null){
        return 'RBC-001';
       }else{
        return $result;
       }
    }

    public function save(Request $request){
        $Rls_brg_Cus = new Rls_brg_Cus();

        $Rls_brg_Cus->kode_cus = $request->kode_cus;
        $Rls_brg_Cus->kode_brj = $request->kode_brj;
        $Rls_brg_Cus->kode_rbc = $request->kode_rbc;
        $Rls_brg_Cus->nama_brg_cus = $request->nama_brg_cus;
        $Rls_brg_Cus->kode_part = $request->kode_part;
        $Rls_brg_Cus->harga_jual = $request->harga_jual;
        $Rls_brg_Cus->satuan_jual = $request->satuan_jual;
        return $Rls_brg_Cus->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function update(Request $request){
        $Rls_brg_Cus = Rls_brg_Cus::find($request->id);

        $Rls_brg_Cus->nama_brg_cus = $request->nama_brg_cus;
        $Rls_brg_Cus->harga_jual = $request->harga_jual;
        $Rls_brg_Cus->satuan_jual = $request->satuan_jual;
        $Rls_brg_Cus->kode_part = $request->kode_part;
        return $Rls_brg_Cus->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function delete(Request $request){
        $Rls_brg_Cus = Rls_brg_Cus::find($request->id);

       return $Rls_brg_Cus->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function search(Request $request){
        $ViewRelasiBarangCustomer = ViewRelasiBarangCustomer::where('nama_brg_cus','like','%'.$request->search.'%')->get();

        return ($ViewRelasiBarangCustomer);
    }

    public function searchData(Request $request){
        $data = Rls_brg_Cus::where('kode_cus', $request->kode_cus)
                            ->where('nama_brg_cus','like','%'.$request->search.'%')
                            ->get();
        return ($data);
    }
}
