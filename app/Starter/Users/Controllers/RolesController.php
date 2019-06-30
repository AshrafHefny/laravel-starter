<?php

namespace App\Starter\Users\Controllers;

use App\Starter\Users\Models\Permission;
use App\Starter\Users\Models\Role;
use App\Starter\Users\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RolesController extends Controller {

    public $model;
    public $module;

    public function __construct(Role $model) {
        $this->middleware(['isSuperAdmin']);
        $this->module = 'roles';
        $this->title = trans('app.Roles');
        $this->model = $model;
    }

    public function getIndex() {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.List') . " " . $this->title;
        $data['rows'] = $this->model->getData()->get();
        return view($this->module . '.index', $data);
    }

    public function getCreate() {
        authorize('create-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Create') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model;
        return view($this->module . '.create', $data);
    }

    public function postCreate(RoleRequest $request) {
        authorize('create-' . $this->module);
        $permissions = Permission::whereIn('name',request()->all()['permissions'])->pluck('id')->toArray();
        if ($row = $this->model->create(request()->except(['parents','q','permissions']))) {
            $row->syncPermissions($permissions);
            flash()->success(trans('app.Created successfully'));
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
    }

    public function getEdit($id) {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        if ($data['row']->is_default) {
            flash()->error(trans('app.This is default role cannot be edited'));
            return back();
        }
        return view($this->module . '.edit', $data);
    }

    public function postEdit(RoleRequest $request, $id) {
        authorize('edit-' . $this->module);
        $row = $this->model->findOrFail($id);

        $permissions = Permission::whereIn('name',request()->all()['permissions'])->pluck('id')->toArray();
        if ($row->is_default) {
            flash()->error(trans('app.This is default role cannot be edited'));
        }
        if ($row->syncPermissions($permissions)) {
            $row->update($request->except(['parents','q','permissions']));
            flash(trans('app.Update successfully'))->success();
            return back();
        }
    }

    public function getView($id) {
        authorize('view-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.view', $data);
    }

    public function getDelete($id) {
        authorize('delete-' . $this->module);
        $row = $this->model->findOrFail($id);
        if ($row->is_default) {
            flash()->error(trans('app.This is default role cannot be deleted'));
            return back();
        }
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return redirect($this->module);
    }

    public function getExport() {
        authorize('view-' . $this->module);
        $rows = $this->model->getData()->get();
        if ($rows->isEmpty()) {
            flash()->error(trans('app.There is no results to export'));
            return back();
        }
        $this->model->export($rows, $this->module);
    }

}
