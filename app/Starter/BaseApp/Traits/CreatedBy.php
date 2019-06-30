<?php

namespace App\Starter\BaseApp\Traits;

use App\Starter\Users\User;
use Illuminate\Support\Facades\DB;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::saved(function ($model) {
            if (!$model->created_by && $model->table != null) {
                if ($user = auth()->user()) {
                    DB::table($model->table)->where('id', $model->id)->update(['created_by' => (@$user->id)? : null]);
                }
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed()->withDefault();
    }
}
