<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        {!! Form::selectRange($name,$start,$end,(@$row->$name)?:(@$value), $attributes) !!}
        @if(@$errors)
        @foreach($errors->get($name) as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
        @endforeach
        @endif
    </div>
</div>
