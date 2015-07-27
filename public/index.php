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
    $conf = $next->getDI()->get('config');
    $response->getBody()->write(' Middleware 3 ' . $conf['mode'] . ' ');

    //throw new \Exception('Custom Error');

    return $next($request, $response);
};

$container = new Container([
    'di' => require '../app/services.php'
]);

$app = new TornadoHttp(
    [
        'App\Middleware\ResponseEmitter',
        'App\Middleware\ErrorHandler',
        ['App\Middleware\TemplateFolders', [require '../app/views.php']],
        ['App\Middleware\RouteDispacher', [require '../app/routes.php']],
        $mid1,
        $mid2
    ],
    $container
);

$app->add($mid3);

$app(ServerRequestFactory::fromGlobals(), new Response());