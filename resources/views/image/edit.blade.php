@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar imagen
                </div>
                <div class="card-body">
                    <form action="{{ route('image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{$image->id}}">
                        <div class="form-group row">
                            <div class="image-container image-container--detail">
                                <img src="{{ route('image.file',['filename'=>$image->image_path])}}" alt="">
                            </div>
                            <label class="col-md-3 col-form-label text-md-right"for="image_path">Imagen</label>
                            <div class="col-md-7">
                                <input class="form-control" type="file" name="image_path" id="image_path" >
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('image_path')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right"for="description">Descripcion</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="description" id="description" value="{{$image->description}}" required>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-8">
                                <input class="btn btn-primary" type="submit" value="Actualizar imagen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection