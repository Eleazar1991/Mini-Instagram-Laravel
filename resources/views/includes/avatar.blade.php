@if(Auth::user()->image)
    <img class="avatar" src="{{ url('user/avatar/'.Auth::user()->image) }}" alt="">
@endif