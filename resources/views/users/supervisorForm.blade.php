<br>
<div class="role role-supervisor" style="display: none;">

    <div class="card-header bd-0 tx-medium bg-light">
        {{ trans('users.Supervisor Data') }}
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0">
        @include('form.select',[
            'name'=>'supervisor_department_id',
            'options'=>$departments,
            'attributes'=>[
                'id'=>'supervisor_department_id',
                'class'=>'form-control',
                'label'=>trans('users.Department'),
                'placeholder'=>trans('users.Department'),
                'stared' => 1,
                ]
            ]
        )

        @php
            $attributes=['class'=>'form-control timepicker','label'=>trans('users.From'),'placeholder'=>trans('users.From'), 'stared' => 1];
        @endphp
        @include('form.input',['name'=>'working_from', 'id' => 'from','type'=>'text','attributes'=>$attributes])

        @php
            $attributes=['class'=>'form-control timepicker','label'=>trans('users.To'),'placeholder'=>trans('users.To'), 'stared' => 1];
        @endphp
        @include('form.input',['name'=>'working_to', 'id'=>'to', 'type'=>'text','attributes'=>$attributes])


        @include('form.multiselect',[
            'name'=>'working_areas[]',
            'error_name'=>'working_areas',
            'options'=>$workingAreas,
            'attributes'=>[
                'id'=>'working_areas',
                'class'=>'form-control select2',
                'label'=>trans('users.working_areas'),
                'placeholder'=> null,
                'stared' => 1,
                ]
            ]
        )

    </div><!-- card-body -->
</div>

@push('js')
    <script>
        /* event listener */
        $("#supervisor_department_id").change(function () {
            $("#working_areas").empty();
            $.get('{{ route('users.getDepartmentWorkingAreas') }}',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    department_id: this.value,
                })
                .success(function(response){
                    $.each(response.workingAreas, function (i, item) {
                        $('#working_areas').append(`<option value="${i}">${item}</option>`);
                    });
                });
        });
    </script>
@endpush