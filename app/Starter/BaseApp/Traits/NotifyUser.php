<?php

namespace App\Starter\BaseApp\Traits;

use App\Starter\Notifications\Notification;

trait NotifyUser {

    public static function bootNotifyUser() {
        static::created(function ($model) {
            if (isset(static::$notificationFields)) {
                $fields = static::$notificationFields;
                $data=[];
                foreach ($fields as $field => $value) {
                    if($field == 'url'){
                        $data[$field]=$value.$model->id;
                    }
                    elseif($field == 'email_notify'){
                        $data[$field]=$value;
                    }
                    else{
                        $data[$field]=$model->$value;
                    }
                }
                $data['from_id']= (auth()->user())?auth()->user()->id:2;
                    Notification::create($data);
            }
        });
    }

}
