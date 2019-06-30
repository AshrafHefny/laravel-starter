@foreach($rows as $key=>$value)
<h5>{{$key}}</h5>
    @foreach($value as $row)
            @if($row->field_type=='file')
                @include('form.file',['name'=>'input_'.$row->id,'attributes'=>['class'=>'form-control custom-file-input','label'=>$row->label,'value'=>$row->value]])
            @else
                @include('form.input',['type'=>$row->field_type,'name'=>'input_'.$row->id,'value'=>$row->value,'attributes'=>['class'=>'form-control '.$row->field_class,'label'=>$row->label,$row->field]])
            @endif
    @endforeach
@endforeach
