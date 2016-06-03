<?php
/**
 * -----------------------------------------------------------------------------------------------------------|
 *                                      TORNADO-HTTP Skeleton Application                                     |
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
 * ---------------------------------- Generated with: http://picascii.com ----------------------------------- |
 */
namespace App;

use DMS\TornadoHttp\TornadoHttp;
use Dotenv\Dotenv;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\ServiceManager\ServiceManager;

require '../vendor/autoload.php';

$dotenv = new Dotenv('../src/App');
$dotenv->load();

$container = new ServiceManager(
    require '../src/App/services.php'
);

$middlewares = array_filter(
    require '../src/App/middlewares.php',
    function ($value) use ($container) {
        return (!isset($value['devs']) || in_array($container->get('Config')->environment, $value['devs']));
    },
    \ARRAY_FILTER_USE_BOTH
);

$app = new TornadoHttp($middlewares);
$app->setDI($container);
$app(ServerRequestFactory::fromGlobals(), new Response());
