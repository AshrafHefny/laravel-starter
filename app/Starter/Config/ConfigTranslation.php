<?php


namespace App\Starter\Config;
use App\Starter\BaseApp\BaseModel;

class ConfigTranslation extends BaseModel
{
    public $timestamps = false;
    protected $table = 'config_translations';
    protected $fillable = [
        'label',
        'value'
    ];
}
