@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('edit-'.$module))
    <a href="{{$module}}/edit/{{$row->id}}" class="btn btn-success">
        <i class="fa fa-edit"></i> {{trans('currencies.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
            @foreach(config("translatable.locales") as $lang)
            <tr>
                <td width="25%" class="align-left">{{trans('currencies.Title')}} {{$lang}}</td>
                <td width="75%" class="align-left">{{@$row->getTranslation('title',$lang)}}</td>
            </tr>
            @endforeach
            <tr>
                <td width="25%" class="align-left">{{trans('currencies.ISO')}}</td>
                <td width="75%" class="align-left">{{@$row->iso}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('currencies.Rate')}}</td>
                <td width="75%" class="align-left">{{@$row->rate}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('currencies.Created by')}}</td>
                <td width="75%" class="align-left">{{@$row->creator->name}}</td>
            </tr>
            
        </table>
    </div>
</div>
@endsection
