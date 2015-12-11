@if($image)

    <article>
        <a href='{{Asset('image/'.$image->id)}}'>
            <img src="{{url('public/'.$image->path)}}" alt="">
        </a>
        <div class="photo_content">
            <p class="title"><b>{{$image->album->title}}</b></p>
            <p class="user_by">{{$image->album->user->name}}</p>
            <div class="view">
                <!--<span class="like"><i class="glyphicon glyphicon-heart like" itemid='{{$image->id}}' itemref='{{url('image/'.$image->id.'?like=true')}}'></i>{{$image->count_like}}</span>-->
            </div>
        </div>
    </article>

@endif