
@foreach(config("translatable.locales") as $lang)
    @include('form.input',['name'=>'title:'.$lang,
        'value'=> $row->translateOrDefault($lang)->title ?? null,
        'type'=>'text','attributes'=>['class'=>'form-control',
        'label'=>trans('currencies.Title').' '.$lang,
        'placeholder'=>trans('currencies.Title'),
        'required'=>1]])
@endforeach

@include('form.input',['name'=>'iso','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('currencies.ISO'),'placeholder'=>trans('currencies.ISO'),'required'=>1]])

@php
    $attributes=['class'=>'form-control','label'=>trans('currencies.Rate'),'placeholder'=>trans('currencies.Rate'),'step'=>'0.01','required'=>1,'min'=>0,'pattern'=>'^\d*(\.\d{0,2})?$'];
@endphp
@include('form.input',['name'=>'rate','type'=>'number','attributes'=>$attributes])

