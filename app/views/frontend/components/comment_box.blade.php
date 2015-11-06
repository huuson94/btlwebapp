@if(Session::has('current_user'))
<form action="{{url('user/ajax-comment')}}" id="comment-form" method="POST">
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="type" value="2">
    <ul>
        <li>
            <p>BÌNH LUẬN</p>
            <textarea class="form-control" name="commentContent" placeholder="Viết bình luận của bạn..."></textarea>
        </li>
        <li>
            <button class="btn btn-danger" name="submit">Bình luận</button>
        </li>
    </ul>
</form>
@else
<ul>
    <li>
        <p>(Đăng nhập để có thể bình luận ...)</p>
    </li>
</ul>  
@endif
<div class="detailBox">
    <div class="titleBox">
        <label>Comment Box</label>
        <span>(Click để thu gọn)</span>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            @foreach ($post->comments as $comment)
            <li>
                <!-- <div class="commenterImage">
                    <img src="http://lorempixel.com/50/50/people/6" />
                </div> -->
                <p>{{$comment->user->name}}</p>
                <div class="commentText">
                    <p class="">{{$comment->content}}</p>
                    <span class="date sub-text">on {{$comment->created_at}}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>