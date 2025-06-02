<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function load(){
        return Supplier::paginate(10);
    }

    public function loadData(){
        return Supplier::all();
    }

      public function save(Request $request){
        $Supplier = new Supplier();

        $Supplier->kode_supplier    = $request->kode_supplier;
        $Supplier->nama_supplier    = $request->nama_supplier;
        $Supplier->notelp_supplier  = $request->notelp_supplier;
        $Supplier->alamat_supplier  = $request->alamat_supplier;
        $Supplier->email_supplier   = $request->email_supplier;
        $Supplier->PPN_supplier     = $request->PPN_supplier;
        $Supplier->NPWP_supplier    = $request->NPWP_supplier;
        $Supplier->PPH23_supplier   = $request->PPH23_supplier;
        $Supplier->CP_supplier      = $request->CP_supplier;

        return $Supplier->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function update(Request $request){
        $Supplier = Supplier::find($request->id);
        $Supplier->kode_supplier    = $request->kode_supplier_edit;
        $Supplier->nama_supplier    = $request->nama_supplier_edit;
        $Supplier->notelp_supplier  = $request->notelp_supplier_edit;
        $Supplier->alamat_supplier  = $request->alamat_supplier_edit;
        $Supplier->email_supplier   = $request->email_supplier_edit;
        $Supplier->PPN_supplier     = $request->PPN_supplier_edit;
        $Supplier->NPWP_supplier    = $request->NPWP_supplier_edit;
        $Supplier->PPH23_supplier   = $request->PPH23_supplier_edit;
        $Supplier->CP_supplier      = $request->CP_supplier_edit;

        return $Supplier->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function delete(Request $request){
        $Supplier = Supplier::find($request->id);
        return $Supplier->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

     public function search(Request $request){
        $Supplier = Supplier::where('nama_supplier','like','%'.$request->search.'%')->get();
        return ($Supplier);
    }
}
