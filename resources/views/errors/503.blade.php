@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<h1 class="error-title">503</h1>
    <h5 class="tx-sm-24 tx-normal">{{trans('app.Service Temporarily Unavailable')}}</h5>
    <p class="mg-b-50">{{trans('app.The server is unable to service your request due to maintenance downtime or capacity problems')}}</p>
@endsection
