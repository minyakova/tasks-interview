<?php
declare(strict_types=1);

namespace App\Infrastructure\Components;

use FastRoute;

class Router
{
    private string $routsPath;

    public function __construct(){

        $this->routsPath = ROOT .'/config/routes.php';

    }


    public function run():void
    {

        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            include($this->routsPath);
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);

        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);


       switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                header('HTTP/1.1 404 Not Found');
                throw new Exception('404 Страница отстутствует');

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                header('HTTP/1.1 405 Method Not Allowed');
                throw new Exception('405 Метод не найден');

            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars
                $handler = explode("/",$handler);

                $controllerName = "App\Infrastructure\Http\\".$handler[0]."Controller";
                $serviceName = "App\Application\Service\UserService";
                $repositoryName = "App\Infrastructure\Repository\UserRepository";

                //DI
                $app = new $controllerName(
                    new $serviceName(
                        new $repositoryName()
                    )
                );

                $actionName = 'action'.ucfirst($handler[1]);

                (!empty($vars))?$app->$actionName($vars):$app->$actionName();

                break;
        }
    }

}

