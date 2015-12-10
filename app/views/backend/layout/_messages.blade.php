<div class='errors-content'>
@if(Session::has('status') && Session::get('status') == false && Session::has('messages'))
    <div class="errors-message">
	    @foreach(Session::get('messages') as $key => $message)
	    @foreach($message as $error)
	    <p class="error-message"><span># </span>{{$error}}</p>
	    @endforeach
	    @endforeach
    </div>
@elseif(Session::has('status') && Session::get('status') == true && Session::has('messages'))
	<div class="success-message">
	    @foreach(Session::get('messages') as $message)
	    <p class="success-message"><span>å</span>{{$message}}</p>
	    @endforeach
    </div>
@endif
</div>