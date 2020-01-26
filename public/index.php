<?php
require_once __DIR__ . '/../src/autoload.php';
require_once '../config/app.php';

use \App\Application;

$app = new Application(app);
$app->configRoutes();
$app->run();