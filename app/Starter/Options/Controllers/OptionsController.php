<?php

namespace App\Starter\Options\Controllers;

use App\Starter\Options\Option;
use App\Starter\Options\Requests\OptionRequest;
use App\Http\Controllers\Controller;

class OptionsController extends Controller {

    public $model;
    public $module;

    public function __construct(Option $model) {
        $this->module = 'options';
        $this->title = trans('app.Options');
        $this->model = $model;
        $this->rules = $model->rules;
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
        $data['row']->is_active = 1;
        return view($this->module . '.create', $data);
    }

    public function postCreate(OptionRequest $request) {
        authorize('create-' . $this->module);
        if ($row = $this->model->create($request->all())) {
            flash()->success(trans('app.Created successfully'));
            return redirect(lang() . '/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return back();
    }

    public function getEdit($id) {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit(OptionRequest $request , $id) {
        authorize('edit-' . $this->module);
        $row = $this->model->findOrFail($id);
        if ($row->update($request->all())) {
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
        $row = $this->model->NotDefault()->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return redirect(lang() . '/' . $this->module);
    }

    public function getExport() {
        authorize('view-' . $this->module);
        $rows = $this->model->getData()->get();
        if ($rows->isEmpty()) {
            flash()->error(trans('app.There is no results to export'));
            return back();
        }
        $this->model->export($rows,$this->module);
    }

}
