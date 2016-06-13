<?php
namespace App\Service\Factory;

use Dotenv\Dotenv;
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
        $dotenv = new Dotenv(__DIR__.'/../../');
        $dotenv->load();
        
        return new Config(require __DIR__.'/../../config.php');
    }
}
