@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    <div class="form-layout form-layout-4">
        {!! Form::model($row,['method' => 'put', 'route' => ['users.putUser',$row->id.'?'.request()->getQueryString()],'files' => true,'id'=>'submitUser', 'onSubmit'=> "return checkform()"] ) !!} {{ csrf_field() }}
        @include($module.'.form',$row)
        <!-- custom-file -->
        <div class="form-layout-footer mg-t-30">
            <button class="btn btn-primary bd-0">{{ trans('app.Save') }}</button>
        </div>
        {!! Form::close() !!}
        <!-- form-layout-footer -->
    </div>
    <!-- form-layout -->
</div>
@endsection
