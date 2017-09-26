<?php

use Psr\Http\Message\ServerRequestInterface;
use CMS\Application;
use CMS\ServiceContainer;
use CMS\Plugins\RoutePlugin;
use CMS\Plugins\ViewPlugin;
use CMS\Plugins\DbPlugin;


require_once __DIR__ .'/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new  Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());


//require_once __DIR__ . '/../src/controllers/posts.php';
require_once __DIR__ . '/../src/router.php';
$app->start();