@if (is_null($row->id))

@include('form.select',['name'=>'type','options'=>$row->getUserTypes(),'attributes'=>['id'=>'user_type','class'=>'form-control','required'=>'required','label'=>trans('users.Type'),'placeholder'=>trans('users.Type')]])

@endif


<div class="is_admin_container">
    <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">{{ trans('users.Role') }} <span class="tx-danger">*</span></label>
        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
            <select id="role_id" name="role_id" class="form-control" style="width: 100%">
                @if(!is_null($row))
                <option  value="">{{ trans('users.Role') }}</option>
                @endif
                @foreach($row->getRoles() as $role)
                    <option  value="{{ $role->id }}" {{ ($row->hasRole($role->name) || old('role_id') == $role->id)? 'selected' : '' }} class="role role-{{$role->type}}" style="display:none">{{ $role->display_name }}</option>
                @endforeach
            </select>
            @if(@$errors)
                @foreach($errors->get('role_id') as $message)
                    <span class='help-inline text-danger'>{{ $message }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>



@php
$attributes=['class'=>'form-control','label'=>trans('users.Name'),'placeholder'=>trans('users.Name'),'required'=>1];
@endphp

@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])
@php
    $attributes=['class'=>'form-control','label'=>trans('users.Email'),'placeholder'=>trans('users.Email')];
@endphp

@include('form.input',['name'=>'email','type'=>'email','attributes'=>$attributes])


@php
$attributes=['class'=>'form-control','label'=>trans('users.Mobile'),'placeholder'=>trans('users.Mobile'),'required'=>1];
@endphp
@include('form.input',['name'=>'mobile_number','type'=>'text','attributes'=>$attributes])


@php
$attributes=['class'=>'form-control','label'=>trans('users.password'),'placeholder'=>trans('users.password'),'stared'=>1];
@endphp
@include('form.password',['name'=>'password','attributes'=>$attributes])

@php
$attributes=['class'=>'form-control','label'=>trans('users.password_confirmation'),'placeholder'=>trans('users.password_confirmation'),'stared'=>1];
@endphp
@include('form.password',['name'=>'password_confirmation','attributes'=>$attributes])

@include('form.boolean',['name'=>'confirmed','attributes'=>['label'=>trans('users.Confirmed')]])

@push('js')
<script>
    $(function() {
        //user_type
        $('#user_type').change(function(e) {

           var type = $(this).val();

           $(".role").hide();
           $(".role-"+type).show();
        });

        $('#user_type').trigger('change');

        @if($row->type)
            $(".role-" + "{{ $row->type }}").show();
        @endif
    });

</script>
@endpush
