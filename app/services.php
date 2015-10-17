<?php

/**
 * Servicios de la Aplicación
 */

return [
    'invokables' => [
        'ViewModel' => '\Zend\View\Model\ViewModel',
        'DateTime' => '\DateTime',
    ],
    'factories' => [
        'Config' =>  function($sm) {
            return new \Zend\Config\Config(require __DIR__ . '/config.php');
        },
        'ResolverPath' => function($sm) {
            return new \Zend\View\Resolver\TemplatePathStack([
                'script_paths' => require __DIR__ . '/views.php'
            ]);
        },
        'Renderer' => function($sm) {
            $renderer = new \Zend\View\Renderer\PhpRenderer();
            $renderer->setResolver($sm->get('ResolverPath'));
            return $renderer;
        },
    ],
    'shared' => [
        'ViewModel' => false,
    ],
];
