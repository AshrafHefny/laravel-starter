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
        <i class="fa fa-edit"></i> {{trans('city.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('city.Name').' '.$lang}}</td>
                    <td width="75%" class="align-left">{{$row->translateOrDefault($lang)->name}}</td>
                </tr>
            @endforeach

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('city.Description').' '.$lang}}</td>
                    <td width="75%" class="align-left">{!! $row->translateOrDefault($lang)->description !!}</td>
                </tr>
            @endforeach
            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('city.service').' '.$lang}}</td>
                    <td width="75%" class="align-left">{{$row->service->translateOrDefault($lang)->name}}</td>
                </tr>
            @endforeach
            <tr>
                <td width="25%" class="align-left">{{trans('city.city_boundaries')}}</td>
                <td width="75%" class="align-left">@include('partials.draw_map_from_polygon' , ['name' => 'city_boundaries' , 'data' => $row->city_boundaries])</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('city.is_active')}}</td>
                <td width="75%" class="align-left">{{$row->is_active ? trans('city.active') : trans('city.notactive')}}</td>
            </tr>

        </table>
    </div>
</div>
@endsection
