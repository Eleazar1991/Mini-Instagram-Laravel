@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
                <div class="card image-detail">
                    <div class="card-header">
                        <div class="container-avatar">
                            <img src="{{ url('user/avatar/'.$image->user->image) }}" alt="">
                            <p> {{$image->user->name.' '.$image->user->surname }} <span class="nickname">{{' | @'.$image->user->nick}}</span></p>
                        </div>
                    </div>

                    <div class="card-body image">
                        <div class="image-container image-container--detail">
                            <img src="{{ route('image.file',['filename'=>$image->image_path])}}" alt="">
                        </div>

                        <div class="description">
                            <span class="nickname">{{'@'.$image->user->nick}}</span>
                            <span class="nickname">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                            <p>{{$image->description}}</p>
                        </div>
                        <div class="likes">
                        <?php $user_like=false;?>
                            @foreach($image->likes as $like)
                                <!-- Comrobar si el usuario le ha dado like a la publicacion -->
                                @if($like->user->id==Auth::user()->id)
                                    <?php $user_like=true;?>
                                @endif
                            @endforeach
                            @if($user_like)
                                <img src="{{ asset('img/hearts-64-red.png')}}" alt="" class="btn-like" data-id="{{$image->id}}">                          
                            @else
                                <img src="{{ asset('img/hearts-64-gray.png')}}" alt="" class="btn-dislike" data-id="{{$image->id}}">
                            @endif
                            <span class="count-likes">{{count($image->likes)}}</span>
                            @if(Auth::user() && Auth::user()->id==$image->user->id)
                                <div class="actions">
                                    <a href="{{route('image.edit',['id'=>$image->id])}}" class="btn btn-sm btn-primary">Modificar</a>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                    Eliminar
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Deseas eliminar esta imagen?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            Si la eliminas no podrás recuperarla
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                            <a href="{{route('image.delete',['id'=>$image->id])}}" class="btn btn-danger">Eliminar definitivamente</a>

                                        </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endif  
                        </div>
                        <div class="clearfix"></div>  
                        <div class="comments">
                            <h2>Comentarios ({{count($image->comments)}})</h2>
                            <hr>
                                @foreach($image->comments as $comment)
                                    <div class="comment">
                                        <span class="nickname">{{'@'.$comment->user->nick}}</span>
                                        <span class="nickname">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                        <p>{{$comment->content}}  
                                            <!-- Si el usuario es el propietario de la publicacion o el propietario del comentario -->
                                            @if(Auth::check() && $comment->user_id==Auth::user()->id || $comment->image->user_id==Auth::user()->id)
                                                <a href="{{ route('comment.delete',['id'=>$comment->id])}}"><img src="{{ asset('img/delete-64.png')}}" alt=""></a>
                                            @endif
                                        </p>
                                       
                                    </div>
                                @endforeach
                            @if(count($image->comments)!=0)                        
                                <hr>
                            @endif
                            <form action="{{ route('comment.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                <p>
                                    <textarea class="form-control" name="content"required></textarea>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('content')}}</strong>
                                        </span>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
