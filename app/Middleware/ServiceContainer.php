<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Container\Container;

/**
 * Clase Middleware que registra el contenedor de dependencias de la Aplicación y sus Servicios
 *
 * @package App\Middleware
 */
class ServiceContainer {

    /**
     * @var string Array de configuración de servicios
     */
    private $config;

    /**
     * @var array Archivos con servicios
     */
    private $files;

    /**
     * Constructor
     *
     * @param string $pConfig Archivo de configuración estático
     * @param array $pFiles Archivos de servicios definidos programáticamente
     */
    public function __construct($pConfig, array $pFiles)
    {
        $this->config = $pConfig;
        $this->files  = $pFiles;
    }

    /**
     * Invocación de registración de contenedor de servicios
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */

        $container = null;

        if ($this->config && file_exists($this->config)) {
            $container = new Container([
                'di' => require $this->config
            ]);
        } else {
            $container = new Container();
        }

        foreach ($this->files as $file) {

            if (file_exists($file)) {
                require $file;
            }

        }

        $pNext->setDI($container);

        return $pNext($pRequest, $pResponse);
    }

}