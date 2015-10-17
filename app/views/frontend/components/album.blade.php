<li class="item-image album">
    <article>
        @if($album->image->count() > 1)
        <a href='{{Asset('album/view/'.$album->id)}}'>
            <img src="{{url('public/'.$album->image->first()->path)}}" alt="{{$album->title}}">
        </a>
        <div class="photo_content">
            <p class="sum-images">Album có: {{$album->image->count()}} ảnh</p>
                <p class="title">Title: {{$album->title}}</p>
                <p class="user_by">{{$album->user->name}}</p>
                <div class="view">
                    <span class="like"><i class="glyphicon glyphicon-heart"></i> {{$album->image->sum('count_like')}}</span>
                    <span class="share"><i class='glyphicon glyphicon-share'></i> {{$album->image->sum('count_share')}}</span>
                </div>
        </div>
        @endif
    </article>
</li>
