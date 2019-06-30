<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label text-wrap">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
          @php
           $attributes['style']=@$attributes['style'].'width: 100%;';
           @endphp
            {!! Form::select($name, ['1'=>trans('app.Yes'),'0'=>trans('app.No')],(@$row->$name)?:(@$value), $attributes) !!}   
            @php
            $name=(isset($error_name))?$error_name:$name;     
           @endphp
            @if(@$errors)
            @foreach($errors->get($name) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
            @endif
    </div>
</div>



