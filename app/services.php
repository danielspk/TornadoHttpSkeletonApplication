<?php

/**
 * Servicios para la Aplicación
 */

/** @var \DMS\TornadoHttp\TornadoHttp $pNext */
/** @var \League\Container\Container $container */
$container = $pNext->getDI();

$container->singleton('plates', function(){
    return new League\Plates\Engine();
});
