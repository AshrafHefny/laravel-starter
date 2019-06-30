@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{trans('app.Forbidden action')}}
</h6>
@endsection
@section('content')


<h1 class="error-title">403</h1>
    <h5 class="tx-sm-24 tx-normal">{{trans('app.You are not allowed to do this action')}}</h5>
    <p class="mg-b-50">{{trans('app.You are not allowed to do this action')}}</p>
@endsection
