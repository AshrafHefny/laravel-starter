			<tr>
                <td width="25%" class="align-left">{{trans('users.Contractor name')}}</td>
                <td width="75%" class="align-left">{{$row->worker->contractor->user->name}}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('users.Contractor mobile number')}}</td>
                <td width="75%" class="align-left">{{$row->worker->contractor->user->mobile_number}}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('users.National ID')}}</td>
                <td width="75%" class="align-left">{{$row->worker->national_id}}</td>
            </tr>
