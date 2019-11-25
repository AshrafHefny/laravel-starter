@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('edit-'.$module) && ! $row->deleted_at)
    <a href="{{$module}}/edit/{{$row->id}}" class="btn btn-success">
        <i class="fa fa-edit"></i> {{trans('users.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
            @if(@$row->is_admin)
            <tr>
                <td width="25%" class="align-left">{{trans('users.Is Admin')}}</td>
                <td width="75%" class="align-left">{{(@$row->is_admin)?trans('app.Yes'):trans('app.No')}}</td>
            </tr>
            @endif

            <tr>
                <td width="25%" class="align-left">{{trans('users.Type')}}</td>
                <td width="75%" class="align-left">{{@$row->type}}</td>
            </tr>
            @if(@$row->role_id)
            <tr>
                <td width="25%" class="align-left">{{trans('users.Role')}}</td>
                <td width="75%" class="align-left">{{@$row->role->name}}</td>
            </tr>
            @endif

            <tr>
                <td width="25%" class="align-left">{{trans('users.name')}}</td>
                <td width="75%" class="align-left">{{@$row->name}}</td>
            </tr>

{{--            <tr>--}}
{{--                <td width="25%" class="align-left">{{trans('users.Address')}}</td>--}}
{{--                <td width="75%" class="align-left">{{@$row->address}}</td>--}}
{{--            </tr>--}}

            <tr>
                <td width="25%" class="align-left">{{trans('users.Email')}}</td>
                <td width="75%" class="align-left">{{@$row->email}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.Mobile')}}</td>
                <td width="75%" class="align-left">{{@$row->mobile_number}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.Confirmed')}}</td>
                <td width="75%" class="align-left">{{@$row->confirmed ? trans('users.Confirmed') : trans('users.Not Confirmed') }}</td>
            </tr>
            @if(@$row->creator->name)
            <tr>
                <td width="25%" class="align-left">{{trans('users.Created by')}}</td>
                <td width="75%" class="align-left">{{@$row->creator->name}}</td>
            </tr>
            @endif



        </table>
    </div>
</div>
@endsection
