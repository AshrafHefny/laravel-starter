@foreach($rows['en'] as $key=>$value)
    @if($key)
    <h5>{{$key}}</h5>
        @foreach(config("translatable.locales") as $lang)
            @if(isset($rows[$lang][$key]) && !is_array($rows[$lang][$key]))
                @include('form.input',['name'=>$lang.'['.$key.']','value'=>$rows[$lang][$key],'type'=>'text','attributes'=>['class'=>'form-control','label'=>ucfirst($lang)]])
            @endif
        @endforeach
    @endif
@endforeach
