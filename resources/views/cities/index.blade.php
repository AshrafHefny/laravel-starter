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

    @component('partials/components/searchBox')

        @slot('header')
            {{ trans('cities.Filter cities') }}
        @endslot
        
        @include('form.select',[
            'name'=>'deleted',
            'options'=> ['no' => trans('app.No'), 'yes' => trans('app.Yes')],
            'value' => request('deleted'),
            'attributes'=>[
                'class'=>'form-control',
                'label'=>trans('app.Deleted'),
                ]
            ]
        )

        @slot('url')
            {{ route('cities.index') }}
        @endslot

    @endcomponent

    @if (!$rows->isEmpty())
    <div class="table-responsive">
        <table class="table display responsive nowrap dataTable">
            <thead>
                <tr>
                    <th class="wd-10p">{{trans('cities.ID')}} </th>
                    <th class="wd-10p">{{trans('cities.Name')}} </th>
                    <th class="wd-15p">{{trans('cities.Description')}} </th>
                    <th class="wd-15p">{{trans('cities.Is active')}} </th>
                    <th class="wd-15p">{{trans('cities.Created at')}} </th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{$row->name}}</td>
                    <td class="center">{!! $row->description !!}</td>
                    <td class="center">{{$row->is_active ? trans('cities.active') : trans('cities.not active')}}</td>
                    <td class="center">{{$row->created_at}}</td>
                    <td class="center">

                        @if(request('deleted') != 'yes')
                            <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->id}}" title="{{trans('city.Edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <a class="btn btn-secondary btn-xs" href="{{route('cities.workingarea.index',[$row->id])}}" title="{{trans('city.Working Areas')}}">
                                <i class="fas fa-sitemap"></i>
                            </a>

                            @if(can('delete-'.$module))
                                <form method="POST" action="{{route('cities.delete' , $row->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" value="Delete Station"
                                            data-confirm="{{trans('city.Are you sure you want to delete this item')}}?">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        @endif

                        <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('city.View')}}">
                            <i class="fa fa-eye"></i>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{trans("city.There is no results")}}
    @endif
    @endif
</div>
@endsection
