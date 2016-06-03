<?php

/**
 * Application Configuration
 */

return [
    'base.path'   => '/',
    'environment' => getenv('ENVIRONMENT') ?: 'develop',
    'templates'   => [
        'dir' => [
            __DIR__.'/Module/Website/Responder/template'
        ],
        'cache' => __DIR__.'/../../storage/cache/templates'
    ],
    'doctrine.orm' => [
        'entities.src' => [
            __DIR__.'/Module/Api/Domain/Entity'
        ],
        'entities.alias' => [
            'Api' => 'App\\Module\\Api\\Domain\\Entity'
        ],
        'db.params' => [
            'driver'   => 'pdo_mysql',
            'host'     => getenv('DB_HOST'),
            'dbname'   => getenv('DB_NAME'),
            'user'     => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD')
        ]
    ],
    'jwt' => [
        'secret' => getenv('JWT_SECRET'),
        'expire' => getenv('JWT_EXPIRE')
    ]
];