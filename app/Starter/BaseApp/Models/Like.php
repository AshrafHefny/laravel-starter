<?php

namespace App\Starter\BaseApp\Models;

use App\Starter\BaseApp\BaseModel;

class Like extends BaseModel
{
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Get all of the owning likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
