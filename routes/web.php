<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;

// Route::get('/', function () {
//     /*
//     //Saco todas las imagenes dela BD
//     $images=Image::all();
//     foreach($images as $image){
//         //Saco el usuario que subio la foto
//         echo '<h4>Usuario</h4><br>';
//         echo $image->user->name.' '.$image->user->surname."<br>";
//         //Muestro las fotos
//         echo "<h4>Fotos del usuario ". $image->user->name.' '.$image->user->surname."</h4><br>";
//         echo $image->image_path."<br>";
//         echo $image->description."<br>";
//         //Si la foto tiene comentarios las muestro
//         if(count($image->comments)>=1){
//             echo '<h4>Comentarios de la foto '.$image->image_path.'</h4><br>';
//             foreach( $image->comments as $comment){
//                 //Mostrar el usuario que ha hecho el comentario
//                 echo $comment->user->name.' '.$comment->user->surname.' : ';
//                 //Mostrar el comentario
//                 echo $comment->content."<br>";
//             }
//         }

//         //Muestro los like de cada imagen
//         echo "LIKES: ".count($image->likes).'<br>';

//         echo "<hr/>";
//     }
//     die();
//     return view('welcome');
//     */
// });
//GENERALES
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//USUARIO
Route::get('/configuration','userController@config')->name('config');
Route::post('/user/update','userController@update')->name('user.update');
Route::get('/user/avatar/{filename}','userController@getImage')->name('user.avatar');
Route::get('/user/profile/{id}','userController@profile')->name('user.profile');
Route::get('/all/{search?}','userController@users')->name('user.users');

//IMAGE
Route::get('/image/create','imageController@create')->name('image.create');
Route::get('/image/file/{filename}','imageController@getImage')->name('image.file');
Route::get('/image/{id}','imageController@detail')->name('image.detail');
Route::post('/image/save','imageController@save')->name('image.save');
Route::get('/image/delete/{id}','imageController@delete')->name('image.delete');
Route::get('/image/update/{id}','imageController@edit')->name('image.edit');
Route::post('/image/update','imageController@update')->name('image.update');

//LIKE
Route::get('/like/{image_id}','likeController@like')->name('like.save');
Route::get('/dislike/{image_id}','likeController@dislike')->name('like.delete');
Route::get('/likes','likeController@likes')->name('like.likes');

//COMMENT
Route::post('/comment/save','commentController@save')->name('comment.save');
Route::get('/comment/delete/{id}','commentController@delete')->name('comment.delete');


