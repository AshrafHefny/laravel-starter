<br>
    
<div class="role role-contractor role-sub_contractor" style="display: none;">

<div

    class="card-header bd-0 tx-medium bg-light"
    >
  {{ trans('users.Contractor area') }}
</div><!-- card-header -->
<div class="card-body bd bd-t-0">

@if(auth()->user()->type !== \App\Starter\Users\UserEnums::CONTRACTOR_TYPE)
    <div class="role role-sub_contractor" style="display: none;">
        @include('form.select',[
          'name'=>'parent_id',
          'options'=>$row->getContractors(),
          'attributes'=>[
              'id'=>'parent_id',
              'class'=>'form-control',
              'label'=>trans('users.Parent'),
              'placeholder'=>trans('users.Parent'),
              'stared' => 1,
              ]
          ]
      )
    </div>
@endif

@if(isset($row->department_id) && auth()->user()->contractor)
    @include('form.input',[
        'name'=>'department_id',
        'type'=>'hidden',
        'value'=> $department_id,
        'attributes'=>[
        'id'=>'department_id',
        'label'=>'',
        ]
    ])
@else
    @include('form.select',[
    'name'=>'department_id',
    'options'=>$departments,
    'attributes'=>[
        'id'=>'department_id',
        'class'=>'form-control',
        'label'=>trans('users.Department'),
        'placeholder'=>trans('users.Department'),
        'stared' => 1,
        ]
    ]
)
@endif

@php
$attributes=['class'=>'form-control timepicker','label'=>trans('users.From'),'placeholder'=>trans('users.From'), 'stared' => 1];
@endphp
@include('form.input',['name'=>'from', 'id' => 'from','type'=>'text','attributes'=>$attributes])

@php
$attributes=['class'=>'form-control timepicker','label'=>trans('users.To'),'placeholder'=>trans('users.To'), 'stared' => 1];
@endphp
@include('form.input',['name'=>'to', 'id'=>'to', 'type'=>'text','attributes'=>$attributes])


@php
$attributes=['class'=>'form-control','label'=>trans('users.Number of workers'),'placeholder'=>trans('users.Number of workers'), 'stared' => 1];
@endphp
@include('form.input',['name'=>'number_of_workers', 'type'=>'text','attributes'=>$attributes])


@if(in_array(auth()->user()->type, [App\Starter\Users\UserEnums::CONTRACTOR_TYPE, App\Starter\Users\UserEnums::SUB_CONTRACTOR_TYPE]))

    @php
    $attributes=['class'=>'form-control','label'=>trans('users.License'),'placeholder'=>trans('users.License')];
    @endphp
    @include('form.input',['name'=>'license', 'type'=>'text','attributes'=>$attributes])

@endif


@include('form.boolean',['name'=>'violation_costs','attributes'=>['label'=>trans('users.violation_costs')]])

@include('form.boolean',['name'=>'cars','attributes'=>['label'=>trans('users.cars')]])

@include('form.multiselect',[
    'name'=>'violations[]',
    'error_name'=>'violations',
    'options'=>$row->getViolations(),
    'attributes'=>[
        'id'=>'violations',
        'class'=>'form-control select2',
        'label'=>trans('users.Violations'),
        'stared' => 1,
        ]
    ]
)

@include('form.multiselect',[
    'name'=>'contractor_working_areas[]',
    'error_name'=>'contractor_working_areas',
    'options'=>$workingAreas,
    'attributes'=>[
        'id'=>'contractor_working_areas',
        'class'=>'form-control select2',
        'label'=>trans('users.working_areas'),
        'placeholder'=> null,
        'stared' => 1,
        ]
    ]
)


<hr>
@if(is_null(request()->old('car')) &&  !$row->contractor )
<div class=" form-layout-4  cloned-row cloned">
    @include('form.input',['name'=>'car[plate_number][]',
                    'type'=>'text','attributes'=>['class'=>'form-control plate_number',
                    'label'=>trans('cars.Plate number'),
                    'placeholder'=>trans('cars.Plate number'),
                    'started' => 1,
                    'max' => 191]])

    @include('form.input',['name'=>'car[manufacturer][]',
        'type'=>'text','attributes'=>['class'=>'form-control manufacturer',
        'label'=>trans('cars.Manufacturer'),
        'placeholder'=>trans('cars.Manufacturer'),
        'max' => 191]])

    @include('form.input',['name'=>'car[license_number][]',
        'type'=>'text','attributes'=>['class'=>'form-control license_number',
        'label'=>trans('cars.License number'),
        'placeholder'=>trans('cars.License number'),
        'started' => 1,
        'max' => 191]])
    @include('form.select',[
    'name'=>'car[car_category_id][]',
    'value'=> $row->car_category_id,
    'options'=> $row->id ? $row->getContractorCars() : [],
    'attributes'=>[
        'id'=>'contractor_cars',
        'class'=>'form-control contractor_cars',
        'label'=>trans('cars.Car Category'),
        'placeholder'=>trans('cars.Select Car Category'),
        ]
    ])
    @include('form.select',['name'=>'car[car_brand_id][]','options'=>$row->getOptionsCarBrand(),
        'attributes'=>['class'=>'form-control car_brand_id',
        'label'=>trans('cars.Car Brand'),
        'placeholder'=>trans('cars.Select Car Brand'),
            ]])


    @include('form.select',['name'=>'car[car_state_id][]','options'=>$row->getOptionsCarState(),
        'attributes'=>['class'=>'form-control car_state_id',
        'label'=>trans('cars.Car State'),
        'placeholder'=>trans('cars.Select Car State'),
        'started' => 1,
        ]])
    <hr>
        <div class="form-layout-footer mg-t-15">
            <button id="more-time" class="btn btn-primary bd-2 more-car">{{ trans('app.Add more car') }}</button>
        </div>
    <hr>
</div>
@elseif(!is_null(request()->old('car')))
    @php $i = 0; @endphp
    @foreach(request()->old('car.plate_number') as  $car)
        <div class=" form-layout-4  cloned-row cloned">
            @if(!is_null(request()->old('car.id.'.$i)))
            @include('form.input',['name'=>'car[id][]' ,'value'=>request()->old('car.id.'.$i), 'type'=>'hidden','attributes'=>['class' => 'inputId']])
            @endif
            @include('form.input',['name'=>'car[plate_number][]',
                'value' => request()->old('car.plate_number.'.$i),
                'error_name' => 'car.plate_number.'.$i,
                'type'=>'text','attributes'=>['class'=>'form-control plate_number',
                'label'=>trans('cars.Plate number'),
                'placeholder'=>trans('cars.Plate number'),

                'max' => 191]])

            @include('form.input',['name'=>'car[manufacturer][]',
                'value' => request()->old('car.manufacturer.'.$i),
                'error_name' => 'car.manufacturer.'.$i,
                'type'=>'text','attributes'=>['class'=>'form-control manufacturer',
                'label'=>trans('cars.Manufacturer'),
                'placeholder'=>trans('cars.Manufacturer'),
                'max' => 191]])

            @include('form.input',['name'=>'car[license_number][]',
                'value' => request()->old('car.license_number.'.$i),
                'error_name' => 'car.license_number.'.$i,
                'type'=>'text','attributes'=>['class'=>'form-control license_number',
                'label'=>trans('cars.License number'),
                'placeholder'=>trans('cars.License number'),

                'max' => 191]])
            @include('form.select',[
                'name'=>'car[car_category_id][]',
                'value' => request()->old('car.car_category_id.'.$i),
                'error_name' => 'car.car_category_id.'.$i,
                'options'=> $row->id ? $row->getContractorCars() : [],
                'attributes'=>[
                    'id'=>'contractor_cars',
                    'class'=>'form-control contractor_cars',
                    'label'=>trans('users.Cars Category'),
                    'placeholder'=>trans('cars.Car Category'),
                    ]
            ])
            @include('form.select',['name'=>'car[car_brand_id]['.$i.']','options'=>$row->getOptionsCarBrand(),
                'value' => request()->old('car.car_brand_id.'.$i),
                'error_name' => 'car.car_brand_id.'.$i,
                'attributes'=>['class'=>'form-control car_brand_id',
                'label'=>trans('cars.Car Brand'),
                'placeholder'=>trans('cars.Select Car Brand'),
                    ]])

            @include('form.select',['name'=>'car[car_state_id]['.$i.']','options'=>$row->getOptionsCarState(),
                'select_type' => 'array',
                'value' => request()->old('car.car_state_id.'.$i),
                'error_name' => 'car.car_state_id.'.$i,
                'attributes'=>['class'=>'form-control car_state_id',
                'label'=>trans('cars.Car State'),
                'placeholder'=>trans('cars.Select Car State'),
                ]])

            <hr>
            @if($i == 0)
            <div class="form-layout-footer mg-t-15">
                <button id="more-time" class="btn btn-primary bd-2 more-car">{{ trans('app.Add more car') }}</button>
            </div>
            @else
                <button class="btn btn-danger delete" id="delete">
                    <i class="fa fa-minus" aria-hidden="true"></i></button>
            @endif
            <hr>
        </div>
        @php $i++ @endphp
    @endforeach
@elseif($row->contractor )
    @php $i = 0; @endphp
    @if($row->contractor->cars()->count() > 0)
    @foreach($row->contractor->cars()->get() as  $car)
        <div class=" form-layout-4  cloned-row cloned">
            @include('form.input',['name'=>'car[id][]' ,'value'=>$car->id, 'type'=>'hidden','attributes'=>['class' => 'inputId']])
            @include('form.input',['name'=>'car[plate_number][]',
                'value' => $car->plate_number,
                'type'=>'text','attributes'=>['class'=>'form-control plate_number',
                'label'=>trans('cars.Plate number'),
                'placeholder'=>trans('cars.Plate number'),

                'max' => 191]])

            @include('form.input',['name'=>'car[manufacturer][]',
                'value' => $car->manufacturer,
                'type'=>'text','attributes'=>['class'=>'form-control manufacturer',
                'label'=>trans('cars.Manufacturer'),
                'placeholder'=>trans('cars.Manufacturer'),
                'max' => 191]])

            @include('form.input',['name'=>'car[license_number][]',
                'value' => $car->license_number,
                'type'=>'text','attributes'=>['class'=>'form-control license_number',
                'label'=>trans('cars.License number'),
                'placeholder'=>trans('cars.License number'),
                'max' => 191]])

            @include('form.select',[
                'name'=>'car[car_category_id][]',
                'value'=> $row->car_category_id,
                'options'=> $row->id ? $row->getContractorCars() : [],
                'attributes'=>[
                    'id'=>'contractor_cars',
                    'class'=>'form-control contractor_cars',
                    'label'=>trans('users.Cars'),
                    ]
            ])


            @include('form.select',['name'=>'car[car_brand_id][]','options'=>$row->getOptionsCarBrand(),
                'value' => $car->car_brand_id,
                'attributes'=>['class'=>'form-control car_brand_id',
                'label'=>trans('cars.Car Brand'),
                'placeholder'=>trans('cars.Select Car Brand'),
                    ]])

            @include('form.select',['name'=>'car[car_state_id][]','options'=>$row->getOptionsCarState(),
                'value' => $car->car_state_id,
                'attributes'=>['class'=>'form-control car_state_id',
                'label'=>trans('cars.Car State'),
                'placeholder'=>trans('cars.Select Car State'),
                ]])

            <hr>
            @if($i == 0)
                <div class="form-layout-footer mg-t-15">
                    <button id="more-time" class="btn btn-primary bd-2 more-car">{{ trans('app.Add more car') }}</button>
                </div>
            @else
                <button class="btn btn-danger delete" id="delete">
                    <i class="fa fa-minus" aria-hidden="true"></i></button>
            @endif
            <hr>
        </div>
        @php $i++ @endphp
    @endforeach
    @else
            <div class=" form-layout-4  cloned-row cloned">
                @include('form.input',['name'=>'car[plate_number][]',
                                'type'=>'text','attributes'=>['class'=>'form-control plate_number',
                                'label'=>trans('cars.Plate number'),
                                'placeholder'=>trans('cars.Plate number'),
                                'started' => 1,
                                'max' => 191]])

                @include('form.input',['name'=>'car[manufacturer][]',
                    'type'=>'text','attributes'=>['class'=>'form-control manufacturer',
                    'label'=>trans('cars.Manufacturer'),
                    'placeholder'=>trans('cars.Manufacturer'),
                    'max' => 191]])

                @include('form.input',['name'=>'car[license_number][]',
                    'type'=>'text','attributes'=>['class'=>'form-control license_number',
                    'label'=>trans('cars.License number'),
                    'placeholder'=>trans('cars.License number'),
                    'started' => 1,
                    'max' => 191]])
                @include('form.select',[
                'name'=>'car[car_category_id][]',
                'value'=> $row->car_category_id,
                'options'=> $row->id ? $row->getContractorCars() : [],
                'attributes'=>[
                    'id'=>'contractor_cars',
                    'class'=>'form-control contractor_cars',
                    'label'=>trans('cars.Car Category'),
                    'placeholder'=>trans('cars.Select Car Category'),
                    ]
            ])
                @include('form.select',['name'=>'car[car_brand_id][]','options'=>$row->getOptionsCarBrand(),
                    'attributes'=>['class'=>'form-control car_brand_id',
                    'label'=>trans('cars.Car Brand'),
                    'placeholder'=>trans('cars.Select Car Brand'),
                        ]])


                @include('form.select',['name'=>'car[car_state_id][]','options'=>$row->getOptionsCarState(),
                    'attributes'=>['class'=>'form-control car_state_id',
                    'label'=>trans('cars.Car State'),
                    'placeholder'=>trans('cars.Select Car State'),
                    'started' => 1,
                    ]])
                <hr>
                <div class="form-layout-footer mg-t-15">
                    <button id="more-time" class="btn btn-primary bd-2 more-car">{{ trans('app.Add more car') }}</button>
                </div>
                <hr>
</div>
    @endif
@endif


</div><!-- card-body -->
</div>


@if(! in_array(auth()->user()->type, ['contractor', 'sub_contractor']))
    @push('js')
        <script>
            $("#department_id").change(function () {
                $("#contractor_working_areas").empty();
                $('#contractor_cars').empty();
                $('#violations').empty();

                $.get('{{ route('users.getDepartmentWorkingAreas') }}',
                    {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        department_id: this.value,
                    })
                    .success(function(response){
                        $.each(response.workingAreas, function (i, item) {
                            $('#contractor_working_areas').append(`<option value="${i}">${item}</option>`);
                        });
                        $.each(response.violations, function (i, item) {
                            $('#violations').append(`<option value="${i}">${item}</option>`);
                        });
                    });
            });
            $('#violations').on('select2:select select2:unselect', function (e) {
                $('.contractor_cars').empty();
                $.post('{{ route('users.getViolationCars') }}',
                    {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        violations: $(this).val(),


                    })
                    .success(function(response){
                        $.each(response.carCategory, function (i, item) {
                            $('.contractor_cars').append(`<option value="${item.id}">${item.title}</option>`);
                        });
                    });
            });
            @if(request()->route('id'))
            $('#violations').trigger('select2:select');
            @endif

            
            var removeButton =
                ('<button class="btn btn-danger delete" id="delete">'
                    +'<i class="fa fa-minus" aria-hidden="true"></i></button>');
            $("#more-time").click(function(e){
                e.preventDefault();
                var cloneRowTrip = $(".cloned:first").clone();
                cloneRowTrip.find(".more-time, .text-danger").remove();
                cloneRowTrip.append(removeButton);
                cloneRowTrip.find('.plate_number').val('');
                cloneRowTrip.find('.manufacturer').val('');
                cloneRowTrip.find('.license_number').val('');
                cloneRowTrip.find('.inputId').remove();
                cloneRowTrip.find(".more-car").remove();
                cloneRowTrip.insertAfter(".cloned:last");
            });
            $('body').on('click','#delete' , function(e){
                e.preventDefault();
                $(this).parent().remove();
                return false;
            });

            function checkform()
            {
                var plate_numbers = $("input[name='car[plate_number][]']")
                .map(function(){return $(this).val();}).get();
                var license_numbers = $("input[name='car[license_number][]']")
                .map(function(){return $(this).val();}).get();
                var ids = $("input[name='car[id][]']")
                .map(function(){return $(this).val();}).get();
                let check = false;
                if (ids.length > 0){

                    $.post('{{ route('users.checkUniqueCar') }}',
                        {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                            ids:ids,
                            plate_numbers: plate_numbers,
                            license_numbers: license_numbers,
                        })
                        .success(function(response){
                            if (response.unique){
                                check = true;
                                console.log(check);
                            }
                            else {
                                alert('{{ trans('users.There is error data in cars, plate number or license number not unique') }}');
                                check = false;
                            }
                        });
                    return true;
                } else {
                    return true;
                }
            }
        </script>
    @endpush

@endif
