@extends('layouts.master')

@section('title')
    <h6 class="slim-pagetitle"> {{ trans('dashboard.Welcome') .', '.auth()->user()->name }}</h6>
@endsection

@section('content')
<div class="section-wrapper">
    Default Dashboard
</div>
@endsection
