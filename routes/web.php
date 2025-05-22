<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\Auth;
use Illuminate\Http\Request;
use App\Models\Todos;

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

    Route::post('/load-satuan',[SatuanController::class, 'load']);

    Route::post('/save-todo',[TodoController::class, 'save']);

    Route::post('/save-satuan',[SatuanController::class, 'save']);

    // Route::post('/update-todo',[TodoController::class, 'update']);
    Route::post('/update-todo',[TodoController::class, 'updateNew']);

    Route::post('/update-satuan',[SatuanController::class, 'update']);

    Route::post('/delete-todo',[TodoController::class, 'delete']);

    Route::post('/delete-satuan',[SatuanController::class, 'delete']);

    Route::post('/search-todo',[TodoController::class, 'search']);

    Route::post('/upload-foto',[TodoController::class, 'upload']);
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