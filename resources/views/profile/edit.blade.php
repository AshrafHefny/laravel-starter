@extends('layouts.'.$layout)
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    <div class="form-layout form-layout-4">
        {!! Form::model($row,['method' => 'POST', 'files' => true] ) !!}
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $row->id }}">
        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.First name'),'placeholder'=>trans('profile.First name'),'required'=>1];
        @endphp
        @include('form.input',['name'=>'first_name','type'=>'text','attributes'=>$attributes])

        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.Last name'),'placeholder'=>trans('profile.Last name'),'required'=>1];
        @endphp
        @include('form.input',['name'=>'last_name','type'=>'text','attributes'=>$attributes])
        
        
        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.Email'),'placeholder'=>trans('profile.Email'),'required'=>1];
        @endphp
        @include('form.input',['name'=>'email','type'=>'email','attributes'=>$attributes])
        
        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.mobile_number'),'placeholder'=>trans('profile.mobile_number'),'required'=>1];
        @endphp
        @include('form.input',['name'=>'mobile_number','type'=>'text','attributes'=>$attributes])

        @php
            $attributes=['class'=>'form-control','label'=>trans('profile.address'),'placeholder'=>trans('profile.address')];
        @endphp
        @include('form.input',['name'=>'address','type'=>'text','attributes'=>$attributes])

        @php
            $attributes=['label'=>trans('profile.profile_picture')];
        @endphp
        @include('form.normalFile',['name'=>'profile_picture','attributes'=>$attributes])


        @include('form.select',[
            'name'=>'language',
            'options'=> $row->getLocales(),
            'attributes'=>[
                'id'=>'language',
                'class'=>'form-control',
                'label'=>trans('profile.Language'),
                'placeholder'=>trans('profile.Language'),
                ]
            ]
        )

        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.Password'),'placeholder'=>trans('profile.Password')];
        @endphp
        @include('form.password',['name'=>'password','attributes'=>$attributes])

        @php 
        $attributes=['class'=>'form-control','label'=>trans('profile.Password confirmation'),'placeholder'=>trans('profile.Password confirmation')];
        @endphp
        @include('form.password',['name'=>'password_confirmation','attributes'=>$attributes])


        <!-- custom-file -->
        <div class="form-layout-footer mg-t-30">
            <button class="btn btn-primary bd-0">{{ trans('profile.Save') }}</button>
        </div>
        {!! Form::close() !!}
        <!-- form-layout-footer -->
    </div>
    <!-- form-layout -->
</div>
@endsection
