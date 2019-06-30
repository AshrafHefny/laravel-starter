<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label text-wrap ">{{ @$attributes['label'] }} <span
                class="tx-danger">{{ (@$attributes['required'])?'*':'' }} {{ (@$attributes['stared'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        @php
            $attributes['autocomplete']='off';
            if($type == "textarea"){
                $attributes['class'] .= ' summernote';
                        }
        @endphp
        {!! Form::$type($name,(@$row->$name)?:(@$value),$attributes)!!}
        @if(@$errors)
            @php
                $name=(isset($error_name))?$error_name:$name;
            @endphp
            @foreach($errors->get($name) as $message)
                <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
        @endif
    </div>
</div>

