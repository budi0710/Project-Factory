<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Rls_brg_supController;
use App\Http\Controllers\Rls_Brg_CusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangJadiController;
use App\Http\Controllers\DetailBarangController;
use App\Http\Controllers\H_SupplierController;
use App\Http\Controllers\Hpo_customerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\Auth;
use App\Models\Hpo_Customer;
use App\Models\L_d_poc;
use App\Models\Rls_brg_cus;
use App\Models\H_Supplier;
use App\Models\L_d_pos;
use App\Models\Rls_brg_sup;
use App\Models\Satuan;
use App\Models\tb_d_pos;
use Illuminate\Http\Request;
use App\Models\Todos;
use App\Models\ViewRelasiBarangSupplier;

function formatRupiah($angka, $prefix = 'Rp') {
    return $prefix . ' ' . number_format($angka, 0, ',', '.');
}

Route::get('/',function(){
    return redirect('/home');
});

Route::get('/login',function(Request $request){
    $session = $request->session()->get('admin');
    return $session ? redirect('home') : view('login');
});

Route::get('/register',function(Request $request){
    $session = $request->session()->get('admin');
    return $session ? redirect('home') : view('register');
});

Route::middleware([Auth::class])->group(function () {
    Route::get('/home',function(){
        return view('home');
    });

     Route::get('/barang',function(){
        return view('barang');
    });

     Route::get('/satuan',function(){
        return view('satuan');
    });

     Route::get('/jenis',function(){
        return view('jenis');
    });

    Route::get('/profile',function(){
        return view('profile');
    });

    Route::get('/supplier',function(){
        return view('supplier');
    });

    Route::get('/rls_brg_sup',function(){
        return view('rls_brg_sup');
    });

    Route::get('/customer',function(){
        return view('customer');
    });

    Route::get('/brj',function(){
        return view('brj');
    });

    Route::get('/rls_brg_cus',function(){
        return view('rls_brg_cus');
    });

    Route::get('/posuppllier',function(){
        return view('posuppllier');
    });

    Route::get('/add-posuppllier',function(){
        return view('add-posuppllier');
    });

    Route::get('/pocustomer',function(){
        return view('pocustomer');
    });

    Route::get('/add-pocustomer',function(){
        return view('add-pocustomer');
    });

     Route::get('/receive',function(){
        return view('receive');
    });


    Route::get('/edit-data/{id}',function($id){
                $todo = Todos::where('id', $id)->count();
                if ($todo){
                    $todo = Todos::where('id', $id)->get();
                    $todo = $todo[0]; 
                
                    return view('edit-data',[
                        'id' => $todo['id'],
                        'todo' => $todo['todo'],
                        'foto' => $todo['foto']
                    ]);
                }
                return redirect('home');
            });

    Route::post('/load-todo',[TodoController::class, 'load']);

    Route::post('/load-barang',[BarangController::class, 'load']);

    Route::post('/save-barang',[BarangController::class, 'save']);

    Route::post('/update-barang',[BarangController::class, 'update']);

    Route::post('/delete-barang',[BarangController::class, 'delete']);

    Route::post('/search-barang',[BarangController::class, 'search']);

    Route::post('/load-barang-suppllier',[Rls_brg_supController::class, 'loadDataWhere']);

    Route::post('/load-satuan',[SatuanController::class, 'load']);

    Route::post('/load-data-satuan',[SatuanController::class, 'loadData']);

    Route::post('/load-data-jenis',[JenisController::class, 'loadData']);

    Route::post('/load-jenis',[JenisController::class, 'load']);

    Route::post('/save-todo',[TodoController::class, 'save']);

    Route::post('/save-satuan',[SatuanController::class, 'save']);

    Route::post('/save-jenis',[JenisController::class, 'save']);

    // Route::post('/update-todo',[TodoController::class, 'update']);
    Route::post('/update-todo',[TodoController::class, 'updateNew']);

    Route::post('/update-satuan',[SatuanController::class, 'update']);

    Route::post('/update-jenis',[JenisController::class, 'update']);

    Route::post('/delete-todo',[TodoController::class, 'delete']);

    Route::post('/delete-satuan',[SatuanController::class, 'delete']);

    Route::post('/delete-jenis',[JenisController::class, 'delete']);

    Route::post('/search-todo',[TodoController::class, 'search']);

    Route::post('/search-satuan',[SatuanController::class, 'search']);

    Route::post('/search-jenis',[JenisController::class, 'search']);

    Route::post('/upload-foto',[TodoController::class, 'upload']);

    Route::post('/generate-id',[BarangController::class, 'generateId']);

    Route::post('/load-supplier',[SupplierController::class, 'load']);

    Route::post('/load-suppllier-data',[SupplierController::class, 'loadData']);

    Route::post('/delete-supplier',[SupplierController::class, 'delete']);

    Route::post('/update-supplier',[SupplierController::class, 'update']);

    Route::post('/save-supplier',[SupplierController::class, 'save']);

    Route::post('/search-supplier',[SupplierController::class, 'search']);

    Route::post('/load-rls-brg-sup',[Rls_brg_supController::class, 'load']);

    Route::post('/load-data-rls-brg-sup',[Rls_brg_supController::class, 'loadData']);

    Route::post('/update-rls-sup',[Rls_brg_supController::class, 'update']);

    Route::post('/delete-rls-sup',[Rls_brg_supController::class, 'delete']);

    Route::post('/generate-id-rls-sup',[Rls_brg_supController::class, 'generateId']);

    Route::post('/generate-id-sup',[SupplierController::class, 'generateId_sup']);

    Route::post('/load-data-supplier',[SupplierController::class, 'loadData']);

    Route::post('/load-data-barang',[BarangController::class, 'loadData']);

    Route::post('/save-rls-sup',[Rls_brg_supController::class, 'save']);

    Route::post('/search-rls-sup',[Rls_brg_supController::class, 'search']);

    Route::post('/load-h-suppllier',[H_SupplierController::class, 'load']);

    Route::post('/delete-h-supplier',[H_SupplierController::class, 'delete']);

    Route::post('/save-po-suppllier',[H_SupplierController::class, 'save']);

    Route::post('/generate-id-h-supplier',[H_SupplierController::class,'generateNo']);

    Route::post('/generate-kode-spo',[H_SupplierController::class,'generateKodeSpo']);

    Route::post('/save-h-supplier',[H_SupplierController::class,'saveData']);

    Route::post('/search-barang-supplier',[Rls_brg_supController::class,'searchData']);

    Route::post('/generate-id-brj',[BarangJadiController::class, 'generateNewId_BRJ']);

    Route::post('/load-barang-jadi',[BarangJadiController::class, 'load']);

    Route::post('/load-data-barang-jadi',[BarangJadiController::class, 'loadData']);

    Route::post('/save-barang-jadi',[BarangJadiController::class, 'save']);

    Route::post('/update-barang-jadi',[BarangJadiController::class, 'update']);

    Route::post('/delete-barang-jadi',[BarangJadiController::class, 'delete']);

    Route::post('/search-barang-jadi',[BarangJadiController::class, 'search']);

    Route::post('/load-rls-brg-cus',[Rls_Brg_CusController::class, 'load']);

    Route::post('/load-data-rls-brg-cus',[Rls_Brg_CusController::class, 'loadData']);

    Route::post('/update-rls-cus',[Rls_Brg_CusController::class, 'update']);

    Route::post('/save-rls-cus',[Rls_Brg_CusController::class, 'save']);

    Route::post('/delete-rls-cus',[Rls_Brg_CusController::class, 'delete']);

    Route::post('/generate-id-rls-cus',[Rls_Brg_CusController::class, 'generateNewId_rls_RBC']);

    Route::post('/search-rls-cus',[Rls_Brg_CusController::class, 'search']);

    Route::post('/load-detail-barang',[DetailBarangController::class, 'loadWhere']);

    Route::post('/load-customer',[CustomerController::class, 'load']);

    Route::post('/load-data-customer',[CustomerController::class, 'loadData']);

    Route::post('/generate-id-cus',[CustomerController::class, 'generateId_cus']);

    Route::post('/delete-customer',[CustomerController::class, 'delete']);

    Route::post('/update-customer',[CustomerController::class, 'update']);

    Route::post('/save-customer',[CustomerController::class, 'save']);

    Route::post('/search-customer',[CustomerController::class, 'search']);

    Route::post('/load-hpo-customer',[Hpo_customerController::class, 'load']);

    Route::post('/delete-hpo_customer',[Hpo_customerController::class, 'delete']);

    Route::post('/save-hpo_customer',[Hpo_customerController::class, 'save']);

    Route::post('/generate-id-hpo-customer',[Hpo_customerController::class,'generateNo']);

    Route::post('/generate-kode-spk',[Hpo_customerController::class,'generateKodeSpK']);

    Route::post('/save-hpo_customer',[Hpo_customerController::class,'saveData']);

    Route::post('/load-detail-poc',[DetailPocController::class, 'loadWhere']);

    Route::get('/print-pocustomer/{fnopos}',function($fnopos){
        $data = H_Supplier::where('fno_pos',$fnopos)->count();
        if ($data){
            // ambil data detail
             $data_detail_pos =  L_d_poc::where('fno_poc',$fnopos)->get();
             $data_header     = H_Supplier::where('fno_poc',$fnopos)->get();
             $data_header = $data_header[0];
             $kode_rls='';

             $sub_total =0;
            foreach ($data_detail_pos as $x) {
                $kode_rls =  $x['fk_rls'];
                $sub_total += $x['FJumlah'];
            }
             
              $ppn = 0;
              $grand_total = 0;
             if ($data_header['fppn']==1){
                $ppn = 11/100 * $sub_total;
                $grand_total = $ppn + $sub_total;
             }else{
                 $ppn = 0;
                 $grand_total = $sub_total;
             }

             $view_relasi = ViewRelasiBarangSupplier::where('kode_rls',$kode_rls)->get();
             $view_relasi = $view_relasi[0];

             $data = array('data_detail'=>$data_detail_pos,
                            'data_header'=>$data_header,
                                'view_relasi'=>$view_relasi,
                                'data_total'=>$sub_total,
                                'ppn'=>$ppn,
                                'grand_total'=> $grand_total);
            
            return view('print-posupplier',$data);
        }else{
            return redirect('/posuppllier');
        }
    });

    Route::get('/print-posuppllier/{fnopos}',function($fnopos){
        $data = H_Supplier::where('fno_pos',$fnopos)->count();
        if ($data){
            // ambil data detail
             $data_detail_pos =  L_d_pos::where('fno_pos',$fnopos)->get();
             
             $data_header     = H_Supplier::where('fno_pos',$fnopos)->get();
             $data_header = $data_header[0];
             $kode_rls='';

             $sub_total =0;
            foreach ($data_detail_pos as $x) {
                $kode_rls =  $x['fk_rls'];
                $sub_total += $x['FJumlah'];
            }
             
              $ppn = 0;
              $grand_total = 0;
             if ($data_header['fppn']==1){
                $ppn = 11/100 * $sub_total;
                $grand_total = $ppn + $sub_total;
             }else{
                 $ppn = 0;
                 $grand_total = $sub_total;
             }

             $view_relasi = ViewRelasiBarangSupplier::where('kode_rls',$kode_rls)->count();

             if ($view_relasi==0){
                return redirect("/posuppllier");
             }
              $view_relasi = ViewRelasiBarangSupplier::where('kode_rls',$kode_rls)->get();
             $view_relasi = $view_relasi[0];

             $data = array('data_detail'=>$data_detail_pos,
                            'data_header'=>$data_header,
                                'view_relasi'=>$view_relasi,
                                'data_total'=>$sub_total,
                                'ppn'=>$ppn,
                                'grand_total'=> $grand_total);
            
            return view('print-posupplier',$data);
        }else{
            return redirect('/posuppllier');
        }
    });

    Route::get('/edit-posupplier/{fnopos}',function($fnopos){
        $data = H_Supplier::where('fno_pos',$fnopos)->count();
        $data_detail_pos =  L_d_pos::where('fno_pos',$fnopos)->count();

        if ($data){

             $data_header     = H_Supplier::where('fno_pos',$fnopos)->get();
             $data_header     = $data_header[0];

            if ($data_detail_pos==0){
                return redirect('/posuppllier');
            }
              
            $data_detail_pos =  L_d_pos::where('fno_pos',$fnopos)->get();
            $data = array('data_header'=>$data_header,'data_detail'=>$data_detail_pos);

            return view('edit-posupplier',$data);
        }else{
            return redirect('/posupplier');
        }
    });

    Route::post('/delete-barang-supplier-detail',[DetailBarangController::class, 'delete']);
    
});


Route::post('/forgot',[UserController::class, 'forgot']);
Route::post('/login',[UserController::class, 'login']);
// ini route register menuju UserController dengan method register
Route::post('/register',[UserController::class, 'register']);
Route::view('/forgot','forgot');

Route::get('/logout',function(Request $request){
    $request->session()->forget('admin');
    return redirect('/login');
});

Route::get('/md5',function(){
    return md5('123456');
});

Route::get('/test',function(){
    return 'ok';
});