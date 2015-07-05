<?php
namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Provider\Helper\Config;

/**
 * Clase Middleware que registra y carga la configuración de la Aplicación
 *
 * @package App\Middleware
 */
class ConfigLoader {

    /**
     * @var array Archivos de configuración
     */
    private $files;

    /**
     * Constructor
     *
     * @param array $pFiles Archivos de configuración
     */
    public function __construct(array $pFiles)
    {
        $this->files = $pFiles;
    }

    /**
     * Invocación de registración y carga de archivos de configuración
     *
     * @param RequestInterface $pRequest Petición
     * @param ResponseInterface $pResponse Respuesta
     * @param callable $pNext Próximo Middleware
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $pRequest, ResponseInterface $pResponse, callable $pNext)
    {
        /** @var \DMS\TornadoHttp\TornadoHttp $pNext */

        $config = new Config();

        foreach ($this->files as $file) {

            if (file_exists($file)) {
                $config->set(require $file);
            }

        }

        $pNext->setConfig($config);

        return $pNext($pRequest, $pResponse);
    }

}