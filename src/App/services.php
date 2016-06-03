<?php

/**
 * Application Services
 */

return [
    'factories' => [
        'Config'        => App\Service\Factory\ConfigFactory::class,
        'EntityManager' => App\Service\Factory\EntityManagerFactory::class,
        'Template'      => App\Service\Factory\TemplateFactory::class,
        'UrlParameters' => App\Service\Factory\UrlParametersFactory::class,
    ],
    'shared' => []
];
