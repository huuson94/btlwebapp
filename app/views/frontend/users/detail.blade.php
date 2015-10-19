@extends('frontend/layout/master')
@section('script-bot')

@stop
@section('style-bot')
	{{ HTML::style('public/assets/css/users/detail.css') }}
@stop
@section('content')
				<div id="wrapper-header">
					<a href="#">
						<div id="header-right">
						</div>
					</a>
					<a href="#">
						<div id="header-left-blog">
							<div class="table">
								<span class="block-title">Blog của tôi</span>
								<span class="block-counter">0</span>
							</div>
						</div>
					</a>
					<a href="#">
						<div id="header-left-photo">
							<span class="icon-camera"></span>
							<div class="table">
								<span class="block-title">Ảnh của tôi</span>
								<span class="block-counter">4</span>
							</div>
						</div>
					</a>
				</div>
@stop
