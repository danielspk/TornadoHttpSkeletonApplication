<?php

/**
 * Application Routes
 */

$apiRoute  = '/api/v1';

return [
    // Private Backend - Users:
    'postUsers' => [
        'path'        => $apiRoute.'/users',
        'middlewares' => [App\Module\Api\Action\User\CreateAction::class],
        'methods'     => 'POST'
    ],
    'putUsers' => [
        'path'        => $apiRoute.'/users/{id:\d+}',
        'middlewares' => [App\Module\Api\Action\User\ModifyAction::class],
        'methods'     => 'PUT'
    ],
    'deleteUsers' => [
        'path'        => $apiRoute.'/users/{id:\d+}',
        'middlewares' => [App\Module\Api\Action\User\DeleteAction::class],
        'methods'     => 'DELETE'
    ],
    'getUser' => [
        'path'        => $apiRoute.'/users/{id:\d+}',
        'middlewares' => [App\Module\Api\Action\User\SearchAction::class],
        'methods'     => 'GET'
    ],
    'getUsers' => [
        'path'        => $apiRoute.'/users',
        'middlewares' => [App\Module\Api\Action\User\SearchAction::class],
        'methods'     => 'GET'
    ],

    // Public:
    'home' => [
        'path'        => '/',
        'middlewares' => [App\Module\Website\Action\HomeAction::class],
        'methods'     => 'GET'
    ]
];
