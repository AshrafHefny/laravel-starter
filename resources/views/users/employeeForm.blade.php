<br>
<div class="role role-employee" style="display: none;">

    <div class="card-header bd-0 tx-medium bg-light">
        {{ trans('users.Empolyee Data') }}
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0">
        @include('form.select',[
            'name'=>'employee_department_id',
            'options'=>$departments,
            'attributes'=>[
                'id'=>'employee_department_id',
                'class'=>'form-control',
                'label'=>trans('users.Department'),
                'placeholder'=>trans('users.Department'),
                'stared' => 1,
                ]
            ]
        )

    </div>

</div>