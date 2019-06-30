@extends('layouts.login')
@section('content')
<div class="signin-right">
    <div class="signin-box">
        {!! Form::open(['method' => 'post'] ) !!} 
        {{ csrf_field() }}
        <h2 class="signin-title-primary">{{ trans('auth.Welcome back') }}!</h2>
        <h3 class="signin-title-secondary">{{ trans('auth.Sign up') }}.</h3>
        <div class="form-group">
            @php $input = 'name';
            @endphp {!! Form::text($input,request($input),['class'=>'form-control','required'=>'required','placeholder'=>trans('auth.Enter your name')]) !!} @if(@$errors) @foreach($errors->get($input) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span> @endforeach @endif
        </div>
        <div class="form-group">
            @php $input = 'email';
            @endphp {!! Form::text($input,request($input),['class'=>'form-control','required'=>'required','placeholder'=>trans('auth.Enter your email')]) !!} @if(@$errors) @foreach($errors->get($input) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span> @endforeach @endif
        </div>
        <div class="form-group">
            @php $input = 'mobile';
            @endphp {!! Form::text($input,request($input),['class'=>'form-control','required'=>'required','placeholder'=>trans('auth.Enter your mobile')]) !!} @if(@$errors) @foreach($errors->get($input) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span> @endforeach @endif
        </div>
        <!-- form-group -->
        <div class="form-group">
            @php $input = 'password';
            @endphp {!! Form::password($input,['class'=>'form-control','required'=>'required','placeholder'=>trans('auth.Enter your password')])!!} @if(@$errors) @foreach($errors->get($input) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span> @endforeach @endif
        </div>
        <!-- form-group -->
        <div class="form-group mg-b-50">
            @php $input = 'password_confirmation';
            @endphp {!! Form::password($input,['class'=>'form-control','required'=>'required','placeholder'=>trans('auth.Enter your password confirmation')])!!} @if(@$errors) @foreach($errors->get($input) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span> @endforeach @endif
        </div>
        <!-- form-group -->
        <button class="btn btn-primary btn-block btn-signin">{{ trans('auth.Sign Up') }}</button>
        <p class="mg-b-0">{{ trans('auth.Do not have an account') }}? <a href="auth/login">{{ trans('auth.Sign In') }}</a></p>
        {!! Form::close() !!}
    </div>
</div>
<!-- signin-right -->
<div class="signin-left">
    <div class="signin-box">
        <h2 class="slim-logo"><a href="{{App::make('url')->to('/')}}/">{{ appName() }}<span>.</span></a></h2>
        <p>
            {{ welcomeMessage() }}
        </p>
        <p class="tx-12">&copy; {{ trans('auth.Copyright') }} {{ date('Y') }}. {{ trans('auth.All Rights Reserved') }}.</p>
    </div>
</div>
<!-- signin-left -->
@endsection
