<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Clase Middleware que registra el contenedor de dependencias de la Aplicación y sus Servicios
 *
 * @package App\Middleware
 */
class ServiceContainer {

    /**
     * @var array Archivos con servicios
     */
    private $files;

    /**
     * Constructor
     *
     * @param array $pFiles Archivos de servicios definidos programáticamente
     */
    public function __construct(array $pFiles)
    {
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

        $container =  $pNext->getDI();

        if (! $container) {
            return $pNext($pRequest, $pResponse);
        }

        foreach ($this->files as $file) {

            if (file_exists($file)) {
                require $file;
            }

        }

        return $pNext($pRequest, $pResponse);
    }

}