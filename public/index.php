<?php
/**
 * -----------------------------------------------------------------------------------------------------------|
 * TORNADO-HTTP | Skeleton Application                                                                        |
 *                                                                                                            |
 * Tornado HTTP es un Contenedor Middleware para Aplicaciones                                                 |
 *                                                                                                            |
 * -----------------------------------------------------------------------------------------------------------|
 * ATENCIÓN: Edite bajo su riego, el tornado lo puedo arrasar.                                                |
 * -----------------------------------------------------------------------------------------------------------|
 *                                                                                                            |
 *                                                     ,''                                                    |
 *                                                     @@@                                                    |
 *                                                     @@:                                                    |
 *                                                     @@                                                     |
 *                                          @@@@@@@+   @@@@@@@   @@@@@@@`  .@@#:`                             |
 *                                          @@@@@@@@. ;@@@@@@@'  @@@@@@@@    :@@@@@@#,                        |
 *                                          @@`   @@@ @@@   @@' .@@    @@`       ,@@@@@@@,                    |
 *                           .:+@@@@@@      @@    @@@ @@:   @@, +@@    @@`          ,@@@@@@@:                 |
 *                      ;#@@@@@@@'`        :@@    @@+ @@    @@  @@#    @@              '@@@@@@@.              |
 *                  :@@@@@@@'.             @@@    @@  @@   `@@  @@,   #@@                ,@@@@@@@:            |
 *              `+@@@@@@@,                 @@'   @@@ ;@@   +@@  @@   ,@@:                  ,@@@@@@@:          |
 *            ;@@@@@@@:                    @@@@@@@@  @@@   @@# .@@@@@@@@                     @@@@@@@@`        |
 *          #@@@@@@@.                      @@@@@@'   @@:   @@, +@@@@@@.                       :@@@@@@@+       |
 *        @@@@@@@@.                       ,@@                  @@#        @@@'`                `@@@@@@@@      |
 *      '@@@@@@@'                         @@@                  @@.         .@@@@@'`             ,@@@@@@@@     |
 *     @@@@@@@@.               `,;##'.    @@'                  @@            ;@@@@@@+            @@@@@@@@;    |
 *    @@@@@@@@`            `+@@@@@@#                                           '@@@@@@#          ,@@@@@@@@    |
 *   @@@@@@@@+           +@@@@@@@:                                               +@@@@@@;        `@@@@@@@@,   |
 *   @@@@@@@@          #@@@@@@@.                                                   @@@@@@@       `@@@@@@@@#   |
 *  '@@@@@@@@        ,@@@@@@@`                                                      ;@@@@@@      '@@@@@@@@#   |
 *  #@@@@@@@@       '@@@@@@,                                                         '@@@@@:     @@@@@@@@@.   |
 *  ,@@@@@@@@      ,@@@@@@               :##                           +@@#`          @@@@@@    +@@@@@@@@@    |
 *   @@@@@@@@@     @@@@@@            '@@@#                              `@@@@         @@@@@@.  :@@@@@@@@@;    |
 *   ,@@@@@@@@;   ;@@@@@'         `@@@@`                                  @@@@`       @@@@@@# :@@@@@@@@@@     |
 *    ;@@@@@@@@#  @@@@@@.        @@@@                                      @@@@      ,@@@@@@@+@@@@@@@@@@      |
 *     .@@@@@@@@@.#@@@@@@       @@@@             `,''@@@@#;;,.             #@@@:    `@@@@@@@@@@@@@@@@@;       |
 *       @@@@@@@@@@@@@@@@+     `@@@@        `+@@@@@@@@@@@@@@@@@@@;         +@@@@   .@@@@@@@@@@@@@@@@@ `       |
 *        `@@@@@@@@@@@@@@@@    `@@@@       #@@@@@@@@@@@@@@@@@@@@@@@        @@@@@  #@@@@@@@@@@@@@@@@. #.       |
 *           ;@@@@@@@@@@@@@@;   @@@@        @@@@@@@@@@@@@@@@@@@@@@@       @@@@@++@@@@@@@@@@@@@@@@` ,@@        |
 *              ;@@@@@@@@@@@@@#.;@@@@.       @@@@@@@@@@@@@@@@@@@@@`     `@@@@@@@@@@@@@@@@@@@@@:  `@@@'        |
 *                 @@@@@@@@@@@@@@@@@@@@`       ;@@@@@@@@@@@@@@;`      `@@@@@@@@@@@@@@@@@@@@,   `@@@@@         |
 *                 '@@@@#@@@@@@@@@@@@@@@@#.                        .#@@@@@@@@@@@@@@@@@@+.    ,@@@@@@          |
 *                  @@@@@+ `+@@@@@@@@@@@@@@@@@#'``           .;+@@@@@@@@@@@@@@@@@@@+`      +@@@@@@@           |
 *                   +@@@@@;    .:+@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@:.        ;@@@@@@@@#            |
 *                    ,@@@@@@'          `::++#@@@@@@@@@@@@@@@@@@@@@#++::`           ,#@@@@@@@@@@              |
 *                      @@@@@@@@.                                              `'@@@@@@@@@@@@#                |
 *                       `@@@@@@@@@.         ```                       `,;+@@@@@@@@@@@@@@@'`                  |
 *                       #; #@@@@@@@@@.  '#@@@@@@@@@@@+;.,.:'++@@@@@@@@@@@@@@@@@@@@@@#;`         .@+          |
 *                        @@@,,@@@@@@@@@@;     `.:#@@@@@@@@@@@@@@@@@@@@@@@@@@@@#;.`            +@@@           |
 *                         @@@@; :@@@@@@@@@@@;`             `,,,.,,,.,,.`                  `+@@@@@,           |
 *                          @@@@@+  ,@@@@@@@@@@@@#,                                     '@@@@@@@@+            |
 *                           @@@@@@'   .#@@@@@@@@@@@@@@+:`                        .:#@@@@@@@@@@@,             |
 *                            +@@@@@@#     .+@@@@@@@@@@@@@@@@@@@##':,,:,,;'#@@@@@@@@@@@@@@@@@@+               |
 *                             `@@@@@@@@:      .'@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@,                 |
 *                               #@@@@@@@@@;        .:@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#.                     |
 *                                 #@@@@@@@@@@#.          `,:+#@@@@@@@@@@@@@@@@+:.           .@               |
 *                                   #@@@@@@@@@@@@'`                                       '@@+               |
 *                                     :@@@@@@@@@@@@@@+.                                ,@@@@@                |
 *                                        '@@@@@@@@@@@@@@@@#:`                     `,#@@@@@@@'                |
 *                                           `#@@@@@@@@@@@@@@@@@@@@+':;:,,,::;+#@@@@@@@@@@@@'                 |
 *                                               `:#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@                   |
 *                                       `+',`          .+#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@;                     |
 *                                        `@@@@@'`                  `..````......`.`                          |
 *                                          @@@@@@@@.                                                         |
 *                                           :@@@@@@@@@;                                                      |
 *                                             +@@@@@@@@@@@;,`         .,,;;+@@@                              |
 *                                               ;@@@@@@@@@@@@@@@@@@@@@@@@@@@@,                               |
 *                                          @#     `#@@@@@@@@@@@@@@@@@@@@@@@'                                 |
 *                                          '@@@.      :@@@@@@@@@@@@@@@@@#.                                   |
 *                                           @@@@@@.        `;'####+',                                        |
 *                                            +@@@@@@@@',                                                     |
 *                                             .@@@@@@@@@@@@@@@@@@#######`                                    |
 *                                               #@@@@@@@@@@@@@@@@@@@@@@                                      |
 *                                          @.     @@@@@@@@@@@@@@@@@@@:                                       |
 *                                          +@@.     ,#@@@@@@@@@@@@+`                                         |
 *                                           @@@@#,      ``.,,.``                                             |
 *                                            @@@@@@@@@+:';:,,,.`                                             |
 *                                             @@@@@@@@@@@@@@@@@@                                             |
 *                                              ;@@@@@@@@@@@@@@@                                              |
 *                                                '@@@@@@@@@@@`                                               |
 *                                                   ,+@##'`                                                  |
 *                                         @@'`                                                               |
 *                                         '@@@@@@#+;;'#                                                      |
 *                                          @@@@@@@@@@@:                                                      |
 *                                           @@@@@@@@@,                                                       |
 *                                           :@@@@@@@,                                                        |
 *                                            :@@@@@,                                                         |
 *                                             :@@@#                                                          |
 *                                              `@@                                                           |
 *                                                @                                                           |
 *                                                                                                            |
 * ---------------------------------- Generado por: http://picascii.com ------------------------------------- |
 */
namespace App;

use DMS\TornadoHttp\TornadoHttp;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use League\Container\Container;
use App\Provider\Helper\Config;

require '../vendor/autoload.php';

$mid1 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    $response->getBody()->write(' Middleware 1 ');
    return $next($request, $response);
};

$mid2 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    /** @var \Psr\Http\Message\ResponseInterface $response */
    $response = $next($request, $response);
    $response->getBody()->write(' Middleware 2 ');
    return $response;
};

$mid3 = function (RequestInterface $request, ResponseInterface $response, callable $next) {
    /** @var \DMS\TornadoHttp\TornadoHttp $next */
    $conf = $next->getConfig();
    $response->getBody()->write(' Middleware 3 ' . $conf['mode'] . ' ');

    //throw new \Exception('Custom Error');

    return $next($request, $response);
};

// Nota: de requerirse el contenedor puede declararse fuera y ser pasado al constructor de un middleware

$app = new TornadoHttp(
    [
        'App\Middleware\ResponseEmitter',
        'App\Middleware\ErrorHandler',
        ['App\Middleware\ConfigLoader', [['../app/config.php', 'not found']]],
        ['App\Middleware\ServiceContainer', [['../app/services.php', 'not found']]],
        ['App\Middleware\TemplateFolders', [['../app/views.php', 'not found']]],
        ['App\Middleware\RouteContainer', [['../app/routes.php', 'not found']]],
        $mid1,
        $mid2
    ],
    new Container([
        'di' => require '../app/services-map.php'
    ]),
    new Config()
);

$app->add($mid3);

$app->setExceptionHandler(function (RequestInterface $request, ResponseInterface $response, callable $next, \Exception $e) {

    $response = new Response();
    $response = $response->withStatus(500);
    $response->getBody()->write('Personal Error: ' . $e->getMessage() . ', ' . $e->getFile());

    return $response;

});

$app(ServerRequestFactory::fromGlobals(), new Response());