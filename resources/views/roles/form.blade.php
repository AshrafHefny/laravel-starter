@include('form.select',
    [
        'name'=>'type',
        'options'=>$row->getUserTypes(),
        'attributes'=>
        [
            'id'=>'user_type',
            'class'=>'form-control',
            'required'=>'required',
            'label'=>trans('users.Type'),
            'placeholder'=>trans('users.Type')
        ]
    ])
@php
    $attributes=['class'=>'form-control','label'=>trans('roles.Title'),'placeholder'=>trans('roles.Title'),'required'=>1];
@endphp

@php
    $attributes['label'] =trans('roles.Title');
    $attributes['placeholder'] =trans('roles.Title');
@endphp
@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])

@php
    $attributes['label'] =trans('roles.Display Title');
    $attributes['placeholder'] =trans('roles.Display Title');
@endphp
@include('form.input',['name'=>'display_name','type'=>'text','attributes'=>$attributes])
@if(config('modules'))
    @foreach(config('modules') as $key=>$permissions)
        <h5 class="mg-b-10 mg-t-20">
            <label class="ckbox">
                {!! Form::checkbox('parents',NULL,null,['id'=>$key,'class'=>'parents']) !!}
                <span>{{ucfirst($key)}}</span>
            </label>
        </h5>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-lg-3">
                    <label class="ckbox">
                        {!! Form::checkbox('permissions[]',$permission.'-'.$key,($row->hasPermission($permission.'-'.$key)),['id'=>$permission.'-'.$key,'class'=>'childs childs_'.$key,'for'=>$key]) !!}
                        <span>{{ucfirst($permission)}} {{ucfirst($key)}}</span>
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
@endif
@if(@$errors)
    @foreach($errors->get('permissions') as $message)
        <span class='help-inline text-danger'>{{trans('roles.Choose at least 1 permission')}}</span>
    @endforeach
@endif

@push('js')
    <script>
        $('.parents').on('change', function () {
            if ($(this).is(':checked')) {
                $('.childs_' + $(this).attr('id')).prop('checked', true);
            } else {
                $('.childs_' + $(this).attr('id')).prop('checked', false);
            }
        });
        $('.childs').on('change', function () {
            var parent = $(this).attr("for");
            if ($(this).is(':checked')) {
                $('#' + parent).prop('checked', true);
            } else {
                if ($('.childs_' + parent + ":checked").size() == 0) {
                    $('#' + parent).prop('checked', false);
                }
            }
        });
        $('.childs').trigger('change');

    </script>
@endpush
