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
        <i class="fa fa-edit"></i> {{trans('roles.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
            <tr>
                <td width="25%" class="align-left">{{trans('roles.Title')}}</td>
                <td width="75%" class="align-left">{{@$row->name}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('roles.Display Title')}}</td>
                <td width="75%" class="align-left">{{@$row->display_name}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('roles.Permissions')}}</td>
                <td width="75%" class="align-left">
                    {{implode(', ',($row->permissions()->pluck('name')->toArray())?:[])}}
                </td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('roles.type')}}</td>
                <td width="75%" class="align-left">
                    {{$row->type}}
                </td>
            </tr>
            @if(@$row->creator->name)
            <tr>
                <td width="25%" class="align-left">{{trans('roles.Created by')}}</td>
                <td width="75%" class="align-left">{{@$row->creator->name}}</td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endsection
