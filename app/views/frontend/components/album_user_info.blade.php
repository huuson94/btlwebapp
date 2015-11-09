<ul>
    <li>
        <p><b>Upload by</b></p>
        <p>
            <a href="{{url('user/'.$image->album->user->id)}}" class="user_name">
                <p>{{$image->album->user->name}}</p>
                <div ><img class='img-rounded avatar' src='{{url($image->album->user->avatar)}}'></div>
            </a>
        </p>
    </li>
    <li>
        <p><b>Description</b></p>
        <p>{{ $album['description'] }}</p>
    </li>
    <li>
        <p><b>Category</b></p>
        <p>{{ $album->category->title}}</p>
    </li>
</ul>