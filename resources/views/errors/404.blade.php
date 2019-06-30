@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')

    <h1 class="error-title">404</h1>
    <h5 class="tx-sm-24 tx-normal">{!!trans('app.Oopps The page you were looking for doesnt exist')!!}</h5>
    <p class="mg-b-50">{{trans('app.You may have mistyped the address or the page may have moved')}}</p>
@endsection
