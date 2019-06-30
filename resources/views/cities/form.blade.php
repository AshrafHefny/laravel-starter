
@foreach(config("translatable.locales") as $lang)
    @include('form.input',['name'=>'name:'.$lang,
        'value'=> $row->translateOrDefault($lang)->name ?? null,
        'type'=>'text','attributes'=>['class'=>'form-control',
        'label'=>trans('city.Name').' '.$lang,
        'placeholder'=>trans('city.Name'),
        'required'=>1]])
@endforeach

@foreach(config("translatable.locales") as $lang)
    @include('form.input',['name'=>'description:'.$lang,
        'value'=> $row->translateOrDefault($lang)->description ?? null,
        'type'=>'textarea','attributes'=>['class'=>'form-control',
        'label'=>trans('city.Description').' '.$lang,
        'placeholder'=>trans('city.Description')]])
@endforeach

@include('form.select',['name'=>'service_id','options'=>$row->getServices(),'attributes'=>['id'=>'service','class'=>'form-control','required'=>'required','label'=>trans('city.service'),'placeholder'=>trans('city.service')]])

@php
    $attributes=['class'=>'form-control','label'=>trans('city.boundaries'),'placeholder'=>trans('city.boundaries')];
@endphp
@include('form.polygon' ,[
    'name'=>'city_boundaries',
    'data_name'=>'city_boundaries_array',
    'editable' => $row->editable === null ? true : $row->editable,
    'all_boundaries' => $row->getAllCitiesBoundaries(),
    'attributes'=>$attributes
    ])



{{Form::hidden('is_active' , '0')}}

@php
    $attributes=['class'=>'form-control','label'=>trans('city.active'),'placeholder'=>trans('city.active')];
@endphp
@include('form.checkbox',['name'=>'is_active','attributes'=>$attributes])


