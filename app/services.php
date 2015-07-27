<?php

return [
    'config' => [
        'class' => '\App\Provider\Helper\Config',
        'arguments' => [
            require __DIR__ . '/config.php'
        ],
        'singleton' => true
    ],
    'plates' => [
        'class' => '\League\Plates\Engine',
        'singleton' => true
    ],
    'datetime' => [
        'class' => '\DateTime',
        'singleton' => true
    ],
];