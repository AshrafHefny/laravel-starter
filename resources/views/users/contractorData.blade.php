            <tr>
                <td width="25%" class="align-left">{{trans('users.Entity')}}</td>
                <td width="75%" class="align-left">{{@$row->contractor->department->entity->title}}</td>
            </tr>

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('users.Department').' '.$lang}}</td>
                    <td width="75%" class="align-left">{{$row->contractor->department->translateOrDefault($lang)->name}}</td>
                </tr>
            @endforeach

            @if($row->type == 'sub_contractor')
                <tr>
                    <td width="25%" class="align-left">{{trans('users.License')}}</td>
                    <td width="75%" class="align-left">{{ $row->contractor->license }}</td>
                </tr>
            @endif


            <tr>
                <td width="25%" class="align-left">{{trans('users.From')}}</td>
                <td width="75%" class="align-left">{{ $row->contractor->from }}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('users.To')}}</td>
                <td width="75%" class="align-left">{{ $row->contractor->to }}</td>
            </tr>


            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('departments.area').' '.$lang}}</td>
                    <td>
                        @foreach($row->contractor->workingAreas as $area)
                            <button class="btn btn-secondary">{{ $area->translateOrDefault($lang)->name }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('departments.Violations').' '.$lang}}</td>
                    <td>
                        @foreach($row->contractor->violations as $violation)
                            <button class="btn btn-secondary">{{ $violation->translateOrDefault($lang)->name }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach

            <tr>
                <td width="25%" class="align-left">{{trans('users.Cars')}}</td>
                <td>

                    @foreach($row->contractor->cars()->get() as $car)
                        <button class="btn btn-secondary">{{ $car->plate_number }}</button>
                    @endforeach
                </td>
            </tr>