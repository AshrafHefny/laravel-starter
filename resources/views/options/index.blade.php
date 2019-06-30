@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
    @if(can('create-'.$module))
    <a href="{{$module}}/create" class="btn btn-success">
        <i class="fa fa-plus"></i> {{trans('app.Create')}}
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
                    <th class="wd-15p">{{trans('options.ID')}} </th>
                    <th class="wd-15p">{{trans('options.Type')}} </th>
                    <th class="wd-15p">{{trans('options.Title')}} </th>
                    <th class="wd-15p">{{trans('options.Is active')}} </th>
                    <th class="wd-15p">{{trans('options.Created at')}}</th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{@$row->getOptionTypes()[$row->type]}}</td>
                    <td class="center">{{str_limit($row->title,25)}}</td>
                    <td class="center"><img src="img/{{($row->is_active)?'check.png':'close.png'}}"></td>
                    <td class="center">{{$row->created_at}}</td>
                    <td class="center">
                        @if(can('edit-'.$module))
                        <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->id}}" title="{{trans('options.Edit')}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endif

                        @if(can('view-'.$module))
                        <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('options.View')}}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @endif

                        @if(can('delete-'.$module)&& !$row->is_default)
                            <form method="POST" action="{{route('options.delete' , $row->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs" value="Delete Station"
                                        data-confirm="{{trans('city.Are you sure you want to delete this item')}}?">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{trans("options.There is no results")}}
    @endif
    @endif
</div>
@endsection
