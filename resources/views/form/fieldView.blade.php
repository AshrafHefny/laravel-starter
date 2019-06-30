<div class="row mg-t-20">
    <label class="col-sm-4">{{ @$attributes['label'] }}</label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        @if(isset($attributes['type']))
            @if(@$attributes['type'] == 'image' )
                {!! viewImage(@$attributes['value'],'small', 'uploads', ['width' => 90]) !!}
            @else
               {!! viewFile(@$attributes['value']) !!}
            @endif
        @else
        {{@$attributes['value']}}
        @endif
    </div>
</div>
