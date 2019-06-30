<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

class DashBoardController extends Controller {
    public $module;

    public function __construct() {
        $this->module='dashboard';
    }

    public function getIndex() {
        $data['page_title']=trans('app.Dashboard');
        return view($this->module.'.index', $data);
    }
}