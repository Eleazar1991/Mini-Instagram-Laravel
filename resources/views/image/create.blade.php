@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subir nueva imagen
                </div>
                <div class="card-body">
                    <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right"for="image_path">Imagen</label>
                            <div class="col-md-7">
                                <input class="form-control" type="file" name="image_path" id="image_path" required>
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
                                <input class="form-control" type="text" name="description" id="description" required>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-8">
                                <input class="btn btn-primary" type="submit" value="Subir imagen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection