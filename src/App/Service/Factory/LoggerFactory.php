<?php
namespace App\Service\Factory;

use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Factory of Logger Service
 *
 * @package App\Service
 */
class LoggerFactory
{
    /**
     * Invocation
     *
     * @param ContainerInterface $container Dependency Injection
     * @return Logger
     */
    public function __invoke(ContainerInterface $container)
    {
        $logger = new Logger('Application');
        $logger->pushHandler(
            new StreamHandler($container->get('Config')->{'dir.path'}.'/storage/logs/app.log', Logger::WARNING)
        );

        return $logger;
    }
}
