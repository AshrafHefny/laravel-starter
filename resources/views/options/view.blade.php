@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('edit-'.$module) )
    <a href="{{$module}}/edit/{{$row->id}}" class="btn btn-success">
        <i class="fa fa-edit"></i> {{trans('options.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
            <tr>
                <td width="25%" class="align-left">{{trans('options.Type')}}</td>
                <td width="75%" class="align-left">{{@$row->getOptionTypes()[$row->type]}}</td>
            </tr>
            @foreach(config("translatable.locales") as $lang)
            <tr>
                <td width="25%" class="align-left">{{trans('options.Title')}} {{$lang}}</td>
                <td width="75%" class="align-left">{{@$row->translateOrDefault($lang)->title}}</td>
            </tr>
            @endforeach
            <tr>
                <td width="25%" class="align-left">{{trans('options.Is active')}}</td>
                <td width="75%" class="align-left"><img src="img/{{($row->is_active)?'check.png':'close.png'}}"></td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('options.Created by')}}</td>
                <td width="75%" class="align-left">{{@$row->creator->name}}</td>
            </tr>

        </table>
    </div>
</div>
@endsection
