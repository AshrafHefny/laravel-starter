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
        <i class="fa fa-arrow-down"></i> {{trans('app.Export')}}
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
                        <th class="wd-10p">{{trans('countries.ID')}} </th>
                        <th class="wd-15p">{{trans('countries.Title')}} </th>
                        <th class="wd-15p">{{trans('countries.ISO')}} </th>
                        <th class="wd-15p">{{trans('countries.Created at')}}</th>
                        <th class="wd-15p">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    <tr>
                        <td class="center">{{$row->id}}</td>
                        <td class="center">{{$row->title}}</td>
                        <td class="center">{{$row->iso}}</td>
                        <td class="center">{{$row->created_at}}</td>
                        <td class="center">
                            @if(can('edit-'.$module))
                            <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->id}}" title="{{trans('countries.Edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endif
                            
                            @if(can('view-'.$module))
                            <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('countries.View')}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endif
                            
                            @if(can('delete-'.$module))
                            <a class="btn btn-danger btn-xs" href="{{$module}}/delete/{{$row->id}}" title="{{trans('countries.Delete')}}" data-confirm="{{trans('countries.Are you sure you want to delete this item')}}?">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        {{trans("countries.There is no results")}}
        @endif
    @endif
</div>
@endsection
