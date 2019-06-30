<?php

namespace App\Starter\BaseApp\Traits;

use Illuminate\Contracts\Validation\Factory;
use Intervention\Image\Facades\Image;
use File;

trait HasAttach {

    public static function bootHasAttach() {
        static::saved(function ($model) {
            $model->autoUpload();
        });
        static::deleted(function ($model) {
            $model->autoDelete();
        });
    }

    protected function autoUpload() {
        if (isset(static::$attachFields)) {
            $fields = static::$attachFields;
            foreach ($fields as $field => $value) {
                if (isset($value['rules'])) {
                    $this->validateImage(request()->file($field), $field, $value['rules']);
                }
                $oldFile = $this->getOriginal($field);
                //////////////////// upload
                if (request()->hasFile($field) && request()->file($field)->isValid()) {
                    $uploadPath = (@$value['path'])? : 'uploads';
                    if (!File::exists($uploadPath)) {
                        @mkdir($uploadPath);
                        @chmod($uploadPath, 0777);
                    }
                    $image = request()->file($field);
                    $fileName = strtolower(str_random(10)) . time() . '.' . $image->getClientOriginalExtension();
                    request()->file($field)->move($uploadPath, $fileName);
                    $filePath = $uploadPath . '/' . $fileName;
                    /////////////////////// resize
                    if ($filePath) {
                        $imageSizes = @$value['sizes'];
                        if ($imageSizes) {
                            foreach ($imageSizes as $key => $value) {
                                $value = explode(',', $value);
                                $type = $value[0];
                                $dimensions = explode('x', $value[1]);
                                if (!File::exists($uploadPath . '/' . $key)) {
                                    @mkdir($uploadPath . '/' . $key);
                                    @chmod($uploadPath . '/' . $key, 0777);
                                }
                                $thumbPath = $uploadPath . '/' . $key . '/' . $fileName;
                                $image = Image::make($filePath);
                                if ($type == 'crop') {
                                    $image->fit($dimensions[0], $dimensions[1]);
                                }
                                else {
                                    $image->resize($dimensions[0], $dimensions[1], function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                }
                                $image->save($thumbPath);
                            }
                            @unlink($filePath);
                        }
                    }
                    ///////////////////////////////////// Delete Old file
                    if ($oldFile) {
                        $this->deleteFile($oldFile, $uploadPath);
                    }
                    //////////////////////////////////// Update Model
                    $this->updateModel($field, $fileName);
                }
            }
        }
    }

    protected function autoDelete() {
//        if ($fields) {
//            foreach ($fields as $field => $value){
//                
//            }
//        }
    }

    protected function updateModel($field, $fileName) {
        $this->attributes[$field] = $fileName;
        $dispatcher = $this->getEventDispatcher();
        self::unsetEventDispatcher();
        $this->save();
        self::setEventDispatcher($dispatcher);
    }

    protected function deleteFile($file_name = "", $path = "uploads") {
        $path = $path . '/';
        if (!@$file_name)
            return false;
        $directories = $this->exploreDirectory($path);
        if ($directories) {
            if (file_exists($path . $file_name)) {

                @unlink($path . $file_name);
            }
            foreach ($directories as $dir) {
                if (file_exists($path . $dir . '/' . $file_name))
                    @unlink($path . $dir . '/' . $file_name);
            }
        }
    }

    private function exploreDirectory($dirPath) {
        if ($handle = @opendir($dirPath)) {
            while (false !== ($file = @readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (@is_dir("$dirPath/$file")) {
                        $arr[] = "$file";
                    }
                }
            }
            closedir($handle);
        }
        if (@$arr)
            return $arr;
    }

    protected function validateImage($file, $fieldName, $rules) {
        if ($rules) {
//            $validator = Validator::make([$fieldName => $file], [$fieldName => $rules]);
//            if ($validator->fails()) {
//                dd('failed');
//                return back();
//            }
//            else{
//                dd('succeded');
//            }
            $this->validationFactory()->make(
                    [$fieldName => $file], [$fieldName => $rules]
            )->validate();
        }
    }

    protected function validationFactory() {
        return app(Factory::class);
    }

}
