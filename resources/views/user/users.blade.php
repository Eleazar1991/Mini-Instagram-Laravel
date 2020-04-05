@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="buscador" action="{{route('user.users')}}" method="get">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>
            <hr>
            @foreach($users as $user)
                @include('includes.userprofile',['user'=>$user])
                <hr>
            @endforeach
            <!-- Paginacion -->
            <div class="clearfix"></div>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
