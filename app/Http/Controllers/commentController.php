<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class commentController extends Controller
{
    //No puedo accede a este controlador si no estoy logueado
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function save(Request $request){

        //Validacion
        $validate=$this->validate($request,[
            'image_id'=>['integer','required'],
            'content'=>['string','required']
        ]);

        //Recogemos los datos
        $user=\Auth::user();
        $content=$request->input('content');
        $image_id=$request->input('image_id');
        
        //Asigno valores a mi nuevo objeto
        $comment=new Comment();
        $comment->user_id=$user->id;
        $comment->image_id=$image_id;
        $comment->content=$content;

        //Guardar en BBDD
        $comment->save();

        //Redireccion
        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'Comentario publicado con éxito']);;

    }

    public function delete($id){
        //Conseguir datos del usuario identificado
        $user=\Auth::user();

        //Conseguir objeto del comentario
        $comment=Comment::find($id);

        //Comprobar si soy el usuario es el dueño del comentario o de la publicacion
        if($user && $comment->user_id==$user->id || $comment->image->user_id==$user->id){
            //Borramos objeto
            $comment->delete();
            return redirect()->route('image.detail',['id'=>$comment->image->id])->with(['message'=>'Comentario eliminado con éxito']);;
        }else{
            return redirect()->route('image.detail',['id'=>$comment->image->id])->with(['message'=>'Comentario no se ha eliminado']);;
        }
    }
}
