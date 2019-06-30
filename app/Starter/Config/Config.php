<?php

namespace App\Starter\Config;

use App\Starter\BaseApp\BaseModel;
use App\Starter\BaseApp\Traits\CreatedBy;
use Astrotomic\Translatable\Translatable;

class Config extends BaseModel {
    use CreatedBy, Translatable;

    protected $table = "configs";

    protected $fillable = [
        'field_type',
        'field_class',
        'type',
        'field',
        'created_by'
    ];

    protected $translationForeignKey = "config_filed_id";
    protected $translatedAttributes = [
        'label',
        'value'
    ];

    public $rules = [
        'type' => 'required',
        'field' => 'required',
    ];

}
