
<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <div class="custom-file">
            {!! Form::file($name,$attributes)!!}

            @if(!$errors->isEmpty())
            <br>
            @foreach($errors->get($name) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
            <br>
            @endif
            
            
        </div>

    </div>
</div>
