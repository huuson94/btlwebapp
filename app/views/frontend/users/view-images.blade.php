@extends('frontend/layout/master')
@section('content')
    <div class="container-div">
		<ul>
			<li class="item-image">
				<article>
					<img src="{{url($images)}}" alt="">
					<div class="photo_content">
						<a href="/home/detail/1"><p class="title">Vietnamese Girl Washing Car</p></a>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
        </ul>
    </div>
@stop