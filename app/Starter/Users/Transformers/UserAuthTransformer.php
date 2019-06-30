<?php

namespace App\Starter\Users\Transformers;

use App\Starter\Users\User;
use League\Fractal\TransformerAbstract;

class UserAuthTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        $transfromedData =  [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'type' => (string) $user->type,
            'email' => (string) $user->email,
            'mobile_number' => (string) $user->mobile_number,
            'address' => (string) $user->address,
            'language' => (string) ($user->language ?? config('app.locale')),
        ];

        if ($user->profile_picture) {
            $transfromedData['profile_picture'] = [
                'small' => (string) image($user->profile_picture, 'small'),
                'large' => (string) image($user->profile_picture, 'large'),
            ];
        } else {
            $transfromedData['profile_picture'] = [
                'small' => 'https://via.placeholder.com/500x500',
                'large' => 'https://via.placeholder.com/500x500',
            ];
        }

        return $transfromedData;
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'type' => 'type',
            'email' => 'email',
            'mobile_number' => 'mobile_number',
            'address' => 'address',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'first_name' => 'name',
            'type' => 'type',
            'email' => 'email',
            'mobile_number' => 'mobile_number',
            'address' => 'address',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
