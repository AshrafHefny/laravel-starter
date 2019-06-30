<?php

namespace App\Starter\Translator\Controllers;

use App\Http\Controllers\Controller;

class TranslatorController extends Controller {

    public $module;

    public function __construct() {
        $this->module = 'translator';
        $this->title = trans('app.Translator');
    }

    public function getIndex() {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Translator');
        $data['rows'] = getListOfFiles(resource_path() . '/lang/en');
        return view($this->module . '.index', $data);
    }

    public function getEdit($file) {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Translator');
        if (!is_array(trans($file))) {
            return abort(404);
        }
        foreach (config("translatable.locales") as $lang) {
            $data['rows'][$lang] = trans($file, [], $lang);
        }
        return view($this->module . '.edit', $data);
    }

    public function postEdit($file) {
        foreach (config("translatable.locales") as $lang) {
            $text = "<?php \n return [\n";
            foreach (request($lang) as $key => $value) {
                $text .= "'{$key}' => '{$value}',\n";
            }
            $text .= "];";
            @file_put_contents(resource_path() . '/lang/' . $lang . '/' . $file . '.php', $text);
        }
        flash(trans('app.Update successfully'))->success();
        return back();
    }

}
