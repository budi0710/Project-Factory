<?php

namespace App\Http\Controllers;
use App\Models\BarangJadi;
use Illuminate\Http\Request;

class BarangJadiController extends Controller
{
    public function load(){
        return BarangJadi::paginate(5);
    }

    public function loadData(){
        return BarangJadi::all();
    }

    public function generateNewId_BRJ(){
       $result  = BarangJadi::select('kode_brj')
                        ->orderBy('kode_brj','desc')
                        ->first();

       if ($result==null){
        return 'FG-001';
       }else{
        return $result;
       }
    }

    public function save(Request $request){
        $file = $request->file('file_barang');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
            $path = $file->store('barang_Jadi', 'public');
            $name = basename($path);
        }

        $data = $request->_data;
        $data = json_decode($data);
        $kode_brj = $data->{'kode_brj'};
        $nama_brj = $data->{'nama_brj'};
        $decription = $data->{'decription'};

        $BarangJadi = new BarangJadi();
        $BarangJadi->kode_brj = $kode_brj;
        $BarangJadi->nama_brj = $nama_brj;
        $BarangJadi->decription = $decription;
        $BarangJadi->foto = $name;

        return $BarangJadi->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

     public function delete(Request $request){
        $BarangJadi = BarangJadi::find($request->id);
       return $BarangJadi->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function search(Request $request){
        $BarangJadi = BarangJadi::where('nama_brj','like','%'.$request->search.'%')->get();
        return ($BarangJadi);
    }

     public function update(Request $request){
        $file = $request->file('file_barang_edit');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
             // Simpan ke storage/app/public/uploads
            $path = $file->store('barang_Jadi', 'public');
            $name = basename($path);
        }

        $data = $request->_data;
        $data = json_decode($data);
       
        $kode_brj = $data->{'kode_brj'};
        $nama_brj = $data->{'nama_brj'};
        $decription = $data->{'decription'};

        $BarangJadi = BarangJadi::find($id);
        $BarangJadi->kode_brj = $kode_brj;
        $BarangJadi->nama_brj = $nama_brj;
        $BarangJadi->decription = $decription;
        $BarangJadi->foto = $name;

        return $BarangJadi->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }
}
