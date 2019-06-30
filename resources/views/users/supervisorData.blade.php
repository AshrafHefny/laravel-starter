            <tr>
                <td width="25%" class="align-left">{{trans('users.Entity')}}</td>
                <td width="75%" class="align-left">{{@$row->supervisor->department->entity->title}}</td>
            </tr>

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('users.Department').' '.$lang}}</td>
                    <td width="75%" class="align-left">{{$row->supervisor->department->translateOrDefault($lang)->name}}</td>
                </tr>
            @endforeach

            <tr>
                <td width="25%" class="align-left">{{trans('users.From')}}</td>
                <td width="75%" class="align-left">{{ $row->supervisor->working_from }}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('users.To')}}</td>
                <td width="75%" class="align-left">{{ $row->supervisor->working_to }}</td>
            </tr>


            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('departments.area').' '.$lang}}</td>
                    <td>
                        @foreach($row->supervisor->workingAreas as $area)
                            <button class="btn btn-secondary">{{ $area->translateOrDefault($lang)->name }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach