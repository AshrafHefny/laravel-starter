<?php

namespace App\Starter\BaseApp\Traits;

use App\Jobs\SendNotificationMail;

trait EmailNotify {

    public static function bootEmailNotify() {
        static::created(function ($model) {
          if($model->email_notify){
            SendNotificationMail::dispatch($model);
          }
        });
    }

}
