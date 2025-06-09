<?php

namespace App\Http\Controllers;

use App\Models\H_Supplier;
use App\Models\tb_d_pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class H_SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveData(Request $request)
    {
        $supplier = new H_Supplier();

        $supplier->fno_pos = $request->no_pos;
        $supplier->fk_sup = $request->result_suppllier;
        $supplier->fpph23 = $request->pph;
        $supplier->fket = $request->ket;
        $supplier->ftgl_pos = $request->tgl_pos;
        $supplier->fk_user = 1;
        $supplier->fppn = $request->ppn;

        //return $supplier->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
         $supplier->save();

        $data = $request->data;
        $data = json_decode($data);
        
       foreach ($data as $item) {
            $kode_rls = $item->kode_rls;
            $harga = $item->harga;
            $qty = $item->qty;
            $no_spo = $item->no_spo;
            $no_pos = $item->no_pos;

            DB::insert('INSERT INTO tb_d_pos (fk_rls, fno_pos,fharga,fqa_pos,fno_spo) VALUES (?, ?, ?, ? , ?)', [$kode_rls, $no_pos,$harga,$qty,$no_spo]);
        }

        return response()->json(['result'=>true]) ;
    }

    /**
     * Display the specified resource.
     */
    public function load()
    {
        return H_Supplier::paginate(10);
    }

    private function getLast3($angka){
           // $angka = "202506001"; // Pastikan ini dalam bentuk string
            $tiga_angka_terakhir = substr($angka, -3);
            return $tiga_angka_terakhir; // Output: 001
    }

    public function generateNo(){
        $result= H_Supplier::select('fno_pos')->orderBy('fno_pos','desc')->first();
       
       if ($result==null){
          return '001';
       }else{
          
          return ($result);
       }
    }

    public function generateKodeSpo(){
         $result= tb_d_pos::select('fno_spo')->orderBy('fno_spo','desc')->first();
       
       if ($result==null){
          return '001';
       }else{
          
          return ($result);
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(request $request)
    {
        $spplier = H_Supplier::find($request->id);
       return $spplier->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }
}
