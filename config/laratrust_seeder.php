<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,v,e,d',
            'config' => 'c,v,e,d',
            'options' => 'c,v,e,d',
            'translator' => 'c,v,e,d',
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'users' => 'c,v,e,d',
            'config' => 'c,v,e,d',
            'options' => 'c,v,e,d',
            'translator' => 'c,v,e,d',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'v' => 'view',
        'e' => 'edit',
        'd' => 'delete',
        'i' => 'categorize'
    ]
];
