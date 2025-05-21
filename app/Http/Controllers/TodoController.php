<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;

class TodoController extends Controller
{
    public function load(){
        return Todos::paginate(10);
    }

    public function save(Request $request){
        //  $request->validate([
        //     'my_foto' => 'required|file|max:6048' // Maks 2MB
        // ]);
      
        $file = $request->file('my_foto');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
             // Simpan ke storage/app/public/uploads
            $path = $file->store('todo', 'public');

            $name = basename($path);
        }

        $id = $request->_data;
        $id = json_decode($id);
       
        $todo = $id->{'todo'};
        $number = $id->{'number'};

        $Todos = new Todos;

        $Todos->todo = $todo;
        $Todos->foto = $name;
        $Todos->number = $number;

        return $Todos->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function updateNew(Request $request){
        $file = $request->file('my_foto_edit');
        $name = '';
        if ($file==null){
            $name = 'no-image.png';
        }else{
             // Simpan ke storage/app/public/uploads
            $path = $file->store('todo', 'public');

            $name = basename($path);
        }

        $id = $request->_data;
        $id = json_decode($id);
       
        $todo = $id->{'todo'};
        $number = $id->{'number'};
        $id = $id->{'id'};

        $Todos = Todos::find($id);

        $Todos->todo = $todo;
        $Todos->foto = $name;
        $Todos->number = $number;

        return $Todos->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function update(Request $request){
        $Todos = Todos::find( $request->id);

        $Todos->todo = $request->todo;

        return $Todos->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function delete(Request $request){
        $Todos = Todos::find($request->id);

       return $Todos->delete() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);
    }

    public function search(Request $request){
        $todos = Todos::where('todo','like','%'.$request->search.'%')->get();

        return ($todos);
    }

    public function upload(Request $request){
        
        $request->validate([
            'my_foto' => 'required|file|max:6048' // Maks 2MB
        ]);
      
        $file = $request->file('my_foto');

        // Simpan ke storage/app/public/uploads
        $path = $file->store('todo', 'public');
        
        $name = basename($path);

        $id = $request->_data;
        $id = json_decode($id);
        $id = $id->{'id'};

        $Todos = Todos::find($id);

        $Todos->foto = $name;

        return $Todos->save() ? response()->json(['result'=>true]) : response()->json(['result'=>false]);

    }
}
