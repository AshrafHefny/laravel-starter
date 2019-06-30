<br>
<div class="role role-worker" style="display: none;">

<div class="card-header bd-0 tx-medium bg-light">
  {{ trans('users.Worker area') }}
</div><!-- card-header -->
<div class="card-body bd bd-t-0">

        @include('form.select',[
          'name'=>'contractor_id',
          'options'=>$row->getAllContractors(),
          'attributes'=>[
              'id'=>'contractor_id',
              'class'=>'form-control',
              'label'=>trans('users.Contractor'),
              'placeholder'=>trans('users.Contractor'),
              'stared' => 1,
              ]
          ]
      )

      @include('form.input',[
          'id'    => 'national_id',
          'name'=>'national_id',
          'value'=> $row->national_id,
          'type'=>'text','attributes'=> ['class'=>'form-control',
          'label' => trans('users.National ID'),
          'placeholder' => trans('users.National ID'),
          'stared' => 1,
      ]])


</div><!-- card-body -->
</div>
