<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Bootstrap',
    ['path' => '/bootstrap'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
