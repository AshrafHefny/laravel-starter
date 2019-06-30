<?php

namespace App\Starter\Options;

use App\Starter\BaseApp\BaseModel;
use Astrotomic\Translatable\Translatable;
use App\Starter\BaseApp\Traits\CreatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends BaseModel
{
    use SoftDeletes,
        CreatedBy,
        Translatable;
    ///////////////////////////// has translation
    protected $table = "options";

    protected $fillable = ['type' , 'is_active'];
    
    protected $translatedAttributes = [
        'title'
    ];

    public $useTranslationFallback = true;


    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function scopeNotDefault($query)
    {
        return $query->where('is_default', '=', 0);
    }

    /////////////////////// Options
    public function getOptionTypes()
    {
        return config('option_types');
    }

    public function getData()
    {
        return $this;
    }

    public function export($rows, $fileName)
    {
        if ($rows) {
            foreach ($rows as $row) {
                unset($object);
                $object['id']=$row->id;
                $object['Type']=$row->type;
                $object['Title']=$row->title;
                $object['Created at']=$row->created_at;
                $labels=array_keys($object);
                $data[]=$object;
            }
            export($data, $labels, $fileName);
        }
    }
}
