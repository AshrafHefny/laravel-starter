@foreach(config("translatable.locales") as $lang)
    @include('form.input',['name'=>'title['.$lang.']','value'=>$row->getTranslation('title',$lang),'type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('countries.Title').' '.$lang,'placeholder'=>trans('countries.Title'),'required'=>1]])
@endforeach
@include('form.input',['name'=>'iso','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('countries.ISO'),'placeholder'=>trans('countries.ISO'),'required'=>1]])
