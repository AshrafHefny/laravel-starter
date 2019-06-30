<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <label class="ckbox">
            {!! Form::checkbox($name,1,(@$value)?:NULL,$attributes) !!}
            <span>{{ @$attributes['placeholder'] }} </span>
        </label>

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
