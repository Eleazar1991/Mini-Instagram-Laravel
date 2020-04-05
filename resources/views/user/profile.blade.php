@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.userprofile')
            @include('includes.message')
            
            <div class="clearfix"></div>
            <hr>
            <h3>Publicaciones ({{count($user->images)}})</h3>
            @foreach($user->images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach

        </div>
    </div>
</div>
@endsection
