<div class="data-user">
    <div class="container-avatar">
        <img src="{{ url('user/avatar/'.$user->image) }}" alt="">
    </div>
    <div class="user-info">
        <p>
        <h1>{{'@'.$user->nick}}</h1>
        <h2>{{$user->name.' '.$user->surname }}</h2>
        <span class="nickname">{{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</span></p>
        <a class="btn btn-success" href="{{route('user.profile',['id'=>$user->id])}}">Ver perfil</a>
    </div>
</div> 