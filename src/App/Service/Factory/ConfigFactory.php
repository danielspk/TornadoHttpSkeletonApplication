<?php
namespace App\Service\Factory;

use Zend\Config\Config;

/**
 * Factory of Config Service
 *
 * @package App\Service
 */
class ConfigFactory
{
    /**
     * Invocation
     *
     * @return Config
     */
    public function __invoke()
    {
        return new Config(require __DIR__.'/../../config.php');
    }
}
