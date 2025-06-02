<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function load(){
        return Customer::paginate(10);
    }

    public function loadData(){
        return Customer::all();
    }

      public function save(Request $request){
        $Customer = new Customer();

        $Customer->kode_cus    = $request->kode_cus;
        $Customer->nama_cus    = $request->nama_cus;
        $Customer->notelp_cus  = $request->notelp_cus;
        $Customer->alamat_cus  = $request->alamat_cus;
        $Customer->email_cus   = $request->email_cus;
        $Customer->PPN_cus     = $request->PPN_cus;
        $Customer->NPWP_cus    = $request->NPWP_cus;
        $Customer->PPH23_cus   = $request->PPH23_cus;
        $Customer->CP_cus      = $request->CP_cus;

        return $Customer->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function update(Request $request){
        $Customer = Customer::find($request->id);
        $Customer->kode_cus    = $request->kode_cus_edit;
        $Customer->nama_cus    = $request->nama_cus_edit;
        $Customer->notelp_cus  = $request->notelp_cus_edit;
        $Customer->alamat_cus  = $request->alamat_cus_edit;
        $Customer->email_cus   = $request->email_cus_edit;
        $Customer->PPN_cus     = $request->PPN_cus_edit;
        $Customer->NPWP_cus    = $request->NPWP_cus_edit;
        $Customer->PPH23_cus   = $request->PPH23_cus_edit;
        $Customer->CP_cus      = $request->CP_cus_edit;

        return $Customer->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function delete(Request $request){
        $Customer = Customer::find($request->id);
        return $Customer->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

     public function search(Request $request){
        $Customer = Customer::where('nama_cus','like','%'.$request->search.'%')->get();
        return ($Customer);
    }
}
