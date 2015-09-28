@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/users/signup.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/users/signup.js') }}
@stop
@section('content')
@if(Session::has('signup_status'))
@if(Session::get('signup_status') == true)
<p class="alert-success">Signuped</p>
@elseif (Session::get('signup_status') == false)
<p class="alert-danger">Can't Signup</p>
@endif
@endif
{{ Form::open(array('url'=>'user/signup', 'method' => 'POST')) }}
<table class="table">
    <tr>
        <th>Name</th>
        <td><input type="text form-control" pattern=".{6,255}" name="name" placeholder="Họ và tên" required title="6 characters minimum"></td>
    </tr>
    <tr>
        <th>User name</th>
        <td><input type="text form-control" pattern=".{6,255}" name="account" placeholder="Nhập tài khoản" required title="6 characters minimum"></td>
    </tr>
    <tr>
        <th>Password</th>
        <td><input type="password" pattern=".{6,255}" name="password" placeholder="Nhập mật khẩu" required title="6 characters minimum"></td>
    </tr>
    <tr>
        <th>Re-password</th>
        <td><input type="password" pattern=".{6,255}" name="password_confirm" placeholder="Nhập lại mật khẩu" required title="6 characters minimum"></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><input type="text form-control" name="email" placeholder="Email( example@gmail.com )"></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><input type="text form-control" name="phone" placeholder="Nhập số điện thoại"></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><input type="text form-control" name="address" placeholder="Nhập địa chỉ"></td>
    </tr>
    <tr>
        <th></th>
        <td><input type="submit" class="btn btn-default" value="Singup"></td>
    <tr>
</table>
{{Form::close()}}
@stop