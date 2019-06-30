@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}

    @if(can('create-'.$module))
    <a href="{{$module}}/create" class="btn btn-success">
        <i class="fa fa-plus"></i> {{trans('app.Create')}}
    </a>
    @endif
    @if(can('view-'.$module))
    <a href="{{$module}}/export?{{@$_SERVER['QUERY_STRING']}}" class="btn btn-primary">
        <i class="fa fa-arrow-up"></i> {{trans('app.Export')}}
    </a>
    @endif
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('view-'.$module))
    @if (!$rows->isEmpty())
    <div class="table-responsive">
        <table class="table display responsive nowrap dataTable">
            <thead>
                <tr>
                    <th class="wd-10p">{{trans('roles.ID')}} </th>
                    <th class="wd-15p">{{trans('roles.Title')}} </th>
                    <th class="wd-15p">{{trans('roles.Display Title')}} </th>
                    <th class="wd-15p">{{trans('roles.type')}} </th>
                    <th class="wd-15p">{{trans('roles.Created at')}}</th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{$row->name}}</td>
                    <td class="center">{{$row->display_name}}</td>
                    <td class="center">{{ $row->type }}</td>
                    <td class="center">{{$row->created_at}}</td>
                    <td class="center">
                        @if(can('view-'.$module))
                        <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('roles.View')}}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @endif
                        @if(!@$row->is_default)
                            @if(can('edit-'.$module))
                            <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->id}}" title="{{trans('roles.Edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endif
                        @endif

                        @if(!@$row->is_default)
                            @if(can('delete-'.$module))
                            <a class="btn btn-danger btn-xs" href="{{$module}}/delete/{{$row->id}}" title="{{trans('roles.Delete')}}" data-confirm="{{trans('roles.Are you sure you want to delete this item')}}?">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{trans("users.There is no results")}}
    @endif
    @endif
</div>
@endsection
