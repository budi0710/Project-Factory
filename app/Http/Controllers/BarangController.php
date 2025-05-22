<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\ViewBarang;

class BarangController extends Controller
{
     public function load(){
        // return Barang::paginate(10);
        return ViewBarang::paginate(5);
    }

    public function save(Request $request){
        $file = $request->file('file_barang');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
           
            $path = $file->store('barang', 'public');

            $name = basename($path);
        }

        $data = $request->_data;
        $data = json_decode($data);
       
        $nama = $data->{'nama'};
        $harga = $data->{'harga'};
        $stock = $data->{'stock'};
        $id_satuan = $data->{'id_satuan'};
        $id_jenis = $data->{'id_jenis'};

        $barang = new Barang();

        $barang->nama = $nama;
        $barang->harga = $harga;
        $barang->stock = $stock;
        $barang->id_satuan = $id_satuan;
        $barang->id_jenis = $id_jenis;
        $barang->foto = $name;

        return $barang->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

     public function delete(Request $request){
        $Barang = Barang::find($request->id);

       return $Barang->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

      public function search(Request $request){
        $viewBarang = ViewBarang::where('nama','like','%'.$request->search.'%')->get();

        return ($viewBarang);
    }

     public function update(Request $request){
        $file = $request->file('file_barang_edit');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
             // Simpan ke storage/app/public/uploads
            $path = $file->store('barang', 'public');

            $name = basename($path);
        }

        $data = $request->_data;
        $data = json_decode($data);
       
        $nama = $data->{'nama'};
        $harga = $data->{'harga'};
        $stock = $data->{'stock'};
        $id = $data->{'id'};
        $id_satuan = $data->{'id_satuan'};
        $id_jenis = $data->{'id_jenis'};

        $barang = Barang::find($id);

        $barang->nama = $nama;
        $barang->harga = $harga;
        $barang->stock = $stock;
        $barang->id_satuan = $id_satuan;
        $barang->id_jenis = $id_jenis;
        $barang->foto = $name;

        return $barang->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }
}
