<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\User;

class userController extends Controller
{
    //No puedo accede a este controlador si no estoy logueado
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        //Conseguir usuario identificado a través de la sesión
        $user= \Auth::user();
        $id=\Auth::user()->id;
        $email=$request->input('email');
        //Validamos los campos de la request, campos nick  y email unicos que coincidan con el del usuario
        $validate=$this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);

        //Recoger datos de formulario
        $name=$request->input('name');
        $surname=$request->input('surname');
        $nick=$request->input('nick');

        //Asignar valores nuevos al usuario
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->email=$email;
        
        //Subir la imagen
        $image= $request->file('image_path');
        if($image){
            //Nombre unico
            $image_path_full=time().$image->getClientOriginalName();
            //Guardo imagen storge/app/users
            Storage::disk('users')->put($image_path_full,File::get($image));
            //Seteo el nombre de la imagen en el objeto
            $user->image=$image_path_full;
        }

        //Ejecutar consulta y cambios a BBDD
        $user->update();
        
        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']); 
    }

    public function getImage($filename){
        $file=Storage::disk('users')->get($filename);
        return new Response($file,200);
    }

    public function profile($id){
        $user=User::find($id);

        return view('user.profile',[
            'user'=>$user
        ]);
    }

    public function users($search=null){
        if(!empty($search)){
            //Si el usuario tiene el nick o el nombre o el apellido 
            $users=User::where('nick','LIKE','%'.$search.'%')
                         ->orWhere('name','LIKE','%'.$search.'%') 
                         ->orWhere('surname','LIKE','%'.$search.'%')    
                         ->orderBy('id','desc')->paginate(5);
        }else{
            $users=User::orderBy('id','desc')->paginate(5);
        }
        
        return view('user.users',[
            'users'=>$users
        ]);
    }
}
