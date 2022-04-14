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

        print_r($dispatcher);

        $actionName = "";
        $actionController = "";

    }

}

