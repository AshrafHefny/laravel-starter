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
            {{ trans('users.Filter users') }}
        @endslot
        
        @if(request('type'))
            <input type="hidden" name="type" value="{{ request('type') ?? '' }}">
        @endif
        
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
            @if(request('type'))
                {{ route('users', request()->only('type')) }}
            @else
                {{ route('users') }}
            @endif
        @endslot

    @endcomponent

    @if (!$rows->isEmpty())
    <div class="table-responsive">
        <table class="table display responsive nowrap">
            <thead>
                <tr>
                    <th class="wd-10p">{{trans('users.ID')}} </th>
                    @if(! request('type'))
                        <th class="wd-10p">{{trans('users.Is Admin')}} </th>
                    @endif
                    <th class="wd-15p">{{trans('users.Name')}} </th>
                    <th class="wd-15p">{{trans('users.Email')}} </th>
                    <th class="wd-15p">{{trans('users.Mobile')}} </th>
                    <th class="wd-15p">{{trans('users.Confirmed')}} </th>
                    <th class="wd-15p">{{trans('users.Created at')}}</th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>

                    @if(! request('type'))
                        <td class="center"><img src="img/{{($row->is_admin)?'check.png':'close.png'}}"></td>
                    @endif

                    <td class="center">{{$row->name}}</td>
                    <td class="center">{{$row->email}}</td>
                    <td class="center">{{$row->mobile_number}}</td>
                    <td class="center">{{$row->confirmed ? trans('users.Confirmed') : trans('users.Not Confirmed')}}</td>
                    <td class="center">{{$row->created_at}}</td>
                    <td class="center">
                        <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('users.View')}}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if(request('deleted') != 'yes')
                            <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->id}}" title="{{trans('users.Edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if(can('delete-'.$module))
                                <form method="POST" action="{{route('users.delete' , $row->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" value="Delete Station"
                                            data-confirm="{{trans('users.Are you sure you want to delete this item')}}?">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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
    
    <br>
    {{ $rows->links() }}
</div>
@endsection
