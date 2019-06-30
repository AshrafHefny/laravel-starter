<?php

namespace App\Starter\Profile\Controllers;

use App\Starter\Profile\Requests\ProfileRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller {
    public $model;
    public $module;

    public function __construct(\App\Starter\Users\User $model) {
        $this->module='profile';
        $this->model=$model;
        $this->rules=$model->rules;
    }

    public function getEdit() {
        $data['row']=$this->model->findOrFail(auth()->user()->id);
        $data['page_title']=trans('profile.Edit Account');
        $data['layout']='master';
        return view($this->module.'.edit', $data);
    }

    public function postEdit(ProfileRequest $request) {
        $row=$this->model->findOrFail(auth()->user()->id);
        if($row->update($request->except(['password_confirmation']))) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }
    }

    public function getLogout() {
        auth()->logout();
        return back();
    }
}
