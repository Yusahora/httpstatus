<?php
    $routes = array(
        'httpstatus' => [
            'home' => '/',
            'login' => '/login',
            'admin' => '/admin',
            'error' => '/error',
            'add' => '/admin/add',
        ],
        'Api' => [
            'home' => '/api/',
            'list' => '/api/list',
            'add' => '/api/add',
            'status' => '/api/status/{id}',
            'history' => '/api/history/{id}',
            'delete' => '/api/delete/{id}'
        ],

    );

    define('ROUTES', $routes);
