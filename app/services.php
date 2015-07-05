<?php

/**
 * Servicios para la Aplicación
 */

/** @var \League\Container\Container $container */

$container->singleton('plates', function(){
    return new League\Plates\Engine();
});
