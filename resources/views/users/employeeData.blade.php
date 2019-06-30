			<tr>
                <td width="25%" class="align-left">{{trans('users.Entity')}}</td>
                <td width="75%" class="align-left">{{@$row->employee->department->entity->title}}</td>
            </tr>

            @foreach(config("translatable.locales") as $lang)
                <tr>
                    <td width="25%" class="align-left">{{trans('users.Department').' '.$lang}}</td>
                    <td width="75%" class="align-left">{{$row->employee->department->translateOrDefault($lang)->name}}</td>
                </tr>
            @endforeach