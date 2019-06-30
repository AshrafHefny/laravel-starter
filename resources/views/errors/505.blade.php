@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<h1 class="error-title">505</h1>
    <h5 class="tx-sm-24 tx-normal">{{trans('app.Oopps Something is broken')}}</h5>
    <p class="mg-b-50">{{trans('appWe've been automatically alerted of the issue and will work to fix it asap')}}</p>

@endsection
