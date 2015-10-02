<?php
use Cake\Routing\Router;

Router::plugin('Security', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
