<?php

////////////// Default Data
function insertDefaultTokens()
{
    $rows = [
    ];
    if ($rows) {
        \DB::table('tokens')->insert($rows);
    }
}

function insertDefaultConfigs()
{
    \Cache::forget('configs');
    @copy(public_path() . '/img/logo.png', storage_path() . '/app/public/uploads/small/logo.png');
    @copy(public_path() . '/img/logo.png', storage_path() . '/app/public/uploads/large/logo.png');
    $rows = [];
    //////////// $appName
    $appName = env('APP_NAME');
    $row = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Basic Information',
        'field' => 'application_name',
        'label' => 'Application Name',
        'value' => $appName,
        'created_by' => 2,
    ];
    $rows[] = $row;
    //////////// $welcome
    $welcome = 'Welcome to our application';
    $row = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Basic Information',
        'field' => 'welcome',
        'label' => 'Welcome Message',
        'value' => $welcome,
        'created_by' => 2,
    ];
    $rows[] = $row;
    ///////////////// Logo
    $rows[] = [
        'field_type' => 'file',
        'field_class' => 'custom-file-input',
        'type' => 'Basic Information',
        'field' => 'logo',
        'label' => 'Logo',
        'value' => 'logo.png',
        'created_by' => 2,
    ];
    ///////////////// Email
    $rows[] = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Contact Information',
        'field' => 'email',
        'label' => 'Email',
        'value' => env('CONTACT_EMAIL', 'contact@starter57.com'),
        'created_by' => 2,
    ];
    ///////////////// Phone
    $rows[] = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Contact Information',
        'field' => 'phone',
        'label' => 'Phone',
        'value' => '12345678',

        'created_by' => 2,
    ];
    ///////////////// Mobile
    $rows[] = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Contact Information',
        'field' => 'mobile',
        'label' => 'Mobile',
        'value' => '12345678',
        'created_by' => 2,
    ];
    ///////////////// longitude
    $rows[] = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Contact Information',
        'field' => 'longitude',
        'label' => 'Locaion (longitude)',
        'value' => '31.324104799999986',
        'created_by' => 2,
    ];
    ///////////////// latitude
    $rows[] = [
        'field_type' => 'text',
        'field_class' => '',
        'type' => 'Contact Information',
        'field' => 'latitude',
        'label' => 'Locaion (latitude)',
        'value' => '30.0685382',
        'created_by' => 2,
    ];
    foreach ($rows as $row) {
        \App\Starter\Config\Config::create($row);
    }
}

function insertDefaultOptions()
{
    $rows = [];
    foreach ($rows as $row) {
        \App\Starter\Options\Option::create($row);
    }
}
