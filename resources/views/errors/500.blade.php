@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')

<h1 class="error-title">500</h1>
    <h5 class="tx-sm-24 tx-normal">{{trans('app.Oopps Internal server error')}}</h5>
    <p class="mg-b-50">{{trans('app.The server encountered an internal server error and was unable to complete your request')}}</p>
@endsection
