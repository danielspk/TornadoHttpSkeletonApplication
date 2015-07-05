<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class TemplateFolders {

    /**
     * @var array Archivos con rutas de templates
     */
    private $files;

    /**
     * Constructor
     *
     * @param array $pFiles Archivos de rutas de templates
     */
    public function __construct(array $pFiles)
    {
        $this->files = $pFiles;
    }

    /**
     * Invocación de carga de archivos de rutas de templates
     *
     * @param RequestInterface $pRequest Peticion
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */
        /** @var \League\Container\Container $container */
        $container = $pNext->getDI();

        if (! $container->isRegistered('plates')) {
            return $pNext($pRequest, $pResponse);
        }

        /** @var \League\Plates\Engine $plates */
        $plates = $container->get('plates');

        foreach ($this->files as $file) {

            if (file_exists($file)) {

                $folders = require $file;

                foreach($folders as $key => $folder) {
                    $plates->addFolder($key, $folder);
                }

            }

        }

        return $pNext($pRequest, $pResponse);
    }

}