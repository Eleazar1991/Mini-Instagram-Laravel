<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Like;

class likeController extends Controller
{
    //No puedo accede a este controlador si no estoy logueado
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id){
        //Recoger datos del usuario y la imagen
        $user=\Auth::user();

        //Comprobar si ya le he dado like a la publicacion
        $isset_like=Like::where('user_id',$user->id)->where('image_id',$image_id)->count();
        if($isset_like==0){
            //Creo objeto like
            $like=new Like();
            $like->user_id=$user->id;
            $like->image_id=(int)$image_id;

            //Guardo en BBDD
            $like->save();

            return response()->json([
                'like'=>$like
            ]);
        }else{
            return response()->json([
                'message'=>'El like ya existe'
            ]);
        }


        
    }

    public function dislike($image_id){

               //Recoger datos del usuario y la imagen
               $user=\Auth::user();

               //Comprobar si ya le he dado like a la publicacion
               $like=Like::where('user_id',$user->id)->where('image_id',$image_id)->first();
               if($like){
                   //Elimino like en  BBDD
                   $like->delete();
       
                   return response()->json([
                       'like'=>$like,
                       'message'=>'Dislike'
                   ]);
               }else{
                   return response()->json([
                       'message'=>'El like no existe'
                   ]);
               }
    }

    public function likes(){
        //Solo saco los likes dados or el usuario identificado
        $user=\Auth::user();
        $likes=Like::where('user_id',$user->id)->orderBy('id','desc')->paginate(5);

        return view('like.likes',[
            'likes'=>$likes
        ]);
    }

}
