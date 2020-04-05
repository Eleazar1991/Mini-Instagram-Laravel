<div class="card">
    <div class="card-header">
        <div class="container-avatar">
            <img src="{{ url('user/avatar/'.$image->user->image) }}" alt="">
            <a href="{{route('user.profile',['id'=>$image->user->id])}}"><p> {{$image->user->name.' '.$image->user->surname }} <span class="nickname">{{' | @'.$image->user->nick}}</span></p></a>
        </div>
            

    </div>

    <div class="card-body image">
        <div class="image-container">
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
        </div>
        <div class="comments">
            <a href="{{route('image.detail',['id'=>$image->id])}}"><img src="{{ asset('img/comments-64.png')}}" alt=""></a>{{' '.count($image->comments)}}
        </div>
    </div>
</div>