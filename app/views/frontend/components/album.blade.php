@if($album)
    <article>
        @if($album->getImages()->count() > 1)
        <a href='{{Asset('album/'.$album->id)}}'>
            <img src="{{url('public/'.$album->getImages()->first()->path)}}" alt="{{$album->title}}">
        </a>
        <div class="photo_content">
            <p class="sum-images">Album có: {{$album->getImages()->count()}} ảnh</p>
                <p class="title">Title: {{$album->title}}</p>
                <p class="user_by">{{$album->user->name}}</p>
                <div class="view">
                    <span class="like"><i class="glyphicon glyphicon-heart"></i> {{$album->getImages()->sum('count_like')}}</span>
                  
                </div>
        </div>
        @endif
    </article>
@endif