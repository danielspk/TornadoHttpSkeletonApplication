<?php

/** @var \DMS\TornadoHttp\TornadoHttp $pNext */
$container = $pNext->getDI();

/**
 * @param $c \Pimple\Container
 * @return \DateTime
 */
$container['fecha'] = function($c) {
    return new \DateTime();
};

/**
 * @param $c \Pimple\Container
 * @return League\Plates\Engine
 */
$container['plates'] = function($c) {
    return new League\Plates\Engine();
};
