<?php
namespace App\Http\Controllers;
use App\Models\H_Supplier;
use App\Models\tb_d_pos;
use App\Models\tb_h_pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class H_SupplierController extends Controller
{
  

    /**
     * Show the form for creating a new resource.
     */
    public function updateData(Request $request)
    {
        //
        $delete = tb_d_pos::where('fno_pos',$request->no_pos)->delete();

        $data_h = tb_h_pos::where('fno_pos',$request->no_pos)->get();
        $id_data_h = $data_h[0]['id'];
      
        $data = $request->data;
        $data = ($data);
      

        for ($i=0; $i < count($data); $i++) { 
             $tmp = $data[$i];
             $kode_rls = $tmp['fk_rls'];
             $harga = $tmp['fharga'];
             $qty = $tmp['fqa_pos'];
             $no_spo = $tmp['fno_spo'];
             $no_pos =$request->no_pos;
             
            DB::insert('INSERT INTO tb_d_pos (fk_rls, fno_pos,fharga,fqa_pos,fno_spo) VALUES (?, ?, ?, ? , ?)', [$kode_rls, $no_pos,$harga,$qty,$no_spo]);
     
        }
        $update = H_Supplier::find($id_data_h);

        $update->fpph23 = $request->pph;
        $update->fket = $request->ket;
        $update->ftgl_pos = $request->tgl_pos;
        $update->fppn = $request->ppn;

        $update->save();

        return response()->json(['result'=>true]) ;
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
        $supplier->fk_user =  $request->session()->get('admin');
        $supplier->fppn = $request->ppn;

        $supplier->save();

        $data = $request->data;
        $data = json_decode($data);
        
       foreach ($data as $item) {
            $kode_rls = $item->kode_rls;
            $harga = $item->harga;
            $qty = $item->qty;
            $no_spo = $item->no_spo;

            $no_pos =$request->no_pos;
          
            DB::insert('INSERT INTO tb_d_pos (fk_rls, fno_pos,fharga,fqa_pos,fno_spo) VALUES (?, ?, ?, ? , ?)', [$kode_rls, $no_pos,$harga,$qty,$no_spo]);
        }

        return response()->json(['result'=>true]) ;
    }

    private function generateFNoPos(array  $existingNumbers): string{
        // Ambil tahun dan bulan saat ini, misalnya 202506
        $prefix = date('Ym');

        // Filter hanya nomor yang sesuai dengan prefix tahun-bulan sekarang
        $filtered = array_filter($existingNumbers, function ($number) use ($prefix) {
            return strpos((string)$number, $prefix) === 0;
        });

        // Ambil 3 digit urutan terakhir dari nomor yang sesuai
        $lastSequence = 0;
        foreach ($filtered as $number) {
            $sequence = (int)substr((string)$number, -3);
            if ($sequence > $lastSequence) {
                $lastSequence = $sequence;
            }
        }

        // Tambahkan 1 ke urutan terakhir
        $nextSequence = $lastSequence + 1;

        // Gabungkan prefix dan nomor urut dengan format 3 digit
        return $prefix . str_pad($nextSequence, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.z
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
     * Remove the specified resource from storage.
     */
    public function delete(request $request)
    {
        // check receive apakah sudah pernah dilakukan transaksi 

        // ambil fno_pos terlebih dahulu
        $fno_pos = H_Supplier::select('fno_pos')->where("id",$request->id)->get();
        // ambil data index ke 0 dan key fno_pos
        $fno_pos = $fno_pos[0]['fno_pos'];
       
        // delete data di table header berdasarkan primary key id
        $supplier = H_Supplier::find($request->id);
        $supplier->delete();

        // delete data di table detail berdasarkan fno_pos
        $detail = tb_d_pos::where('fno_pos',$fno_pos)->delete();
        
        return $supplier ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }
}
