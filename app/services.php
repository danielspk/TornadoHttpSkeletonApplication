<?php

return [
    'invokables' => array(
        'datetime' => '\DateTime',
    ),
    'factories' => array(
        'config' =>  function($sm) {
            return new \App\Provider\Helper\Config(require __DIR__ . '/config.php');
        },
        'plates' =>  function($sm) {
            $plates = new \League\Plates\Engine();

            $folders = require '../app/views.php';

            foreach($folders as $key => $folder) {
                $plates->addFolder($key, $folder);
            }

            return $plates;
        },
    ),
];
