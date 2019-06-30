<?php


namespace App\Starter\Options;
use App\Starter\BaseApp\BaseModel;

class OptionTranslation extends BaseModel
{
    public $timestamps = false;
    protected $table = 'option_translations';
    protected $fillable = [
        'title'
    ];
}
