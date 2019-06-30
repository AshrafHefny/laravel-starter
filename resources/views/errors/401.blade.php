@extends('layouts.errors')
@section('title')
<h6 class="slim-pagetitle">
    {{trans('app.Unauthorized actions')}}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    <h3>{{ @$page_title }}</h3>
    <h3>
        {{trans('app.You are not allowed to do this action')}}
    </h3>
    @php $row=getLicense(); @endphp
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">
            <tr>
                <td width="25%" class="align-left">{{trans('license.Allowed users')}}</td>
                <td width="75%" class="align-left">{{@$row['allowed_users']}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('license.Allowed children')}}</td>
                <td width="75%" class="align-left">{{@$row['allowed_children']}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('license.Allowed staff')}}</td>
                <td width="75%" class="align-left">{{@$row['allowed_staff']}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('license.Allowed parents')}}</td>
                <td width="75%" class="align-left">{{@$row['allowed_parents']}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
