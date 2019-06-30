<br>
<div class="role role-editor" style="display: none;">

<div class="card-header bd-0 tx-medium bg-light">
  {{ trans('users.Editor area') }}
</div><!-- card-header -->
<div class="card-body bd bd-t-0">

      @include('form.input',[
          'id'    => 'birth_date',
          'name'=>'birth_date',
          'value'=> $row->birth_date,
          'type'=>'text','attributes'=> ['class'=>'form-control todayDatePicker',
          'stared' => true,
          'label' => trans('users.Birth date'),
          'placeholder' => trans('users.Birth date')
      ]])


</div><!-- card-body -->
</div>

@push('js')

  <script>
        $(".todayDatePicker").flatpickr({
              enableTime: false,
              dateFormat: "Y-m-d",
              maxDate: "today",
              position: 'above'
          });
  </script>

@endpush
