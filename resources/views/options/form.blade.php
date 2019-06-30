@include('form.select',['name'=>'type','options'=>$row->getOptionTypes(),
    'attributes'=>['class'=>'form-control select2',
    'label'=>trans('options.Type'),
    'placeholder'=>trans('options.Select type'),
    'required'=>1]])
@foreach(config("translatable.locales") as $lang)
    @include('form.input',['name'=>'title:'.$lang,
        'value'=> $row->translateOrDefault($lang)->title ?? null,
        'type'=>'text','attributes'=>['class'=>'form-control',
        'label'=>trans('options.Title').' '.$lang,
        'placeholder'=>trans('options.Title'),
        'required'=>1]])
@endforeach

@include('form.boolean',['name'=>'is_active','attributes'=>['label'=>trans('options.Is active')]])
