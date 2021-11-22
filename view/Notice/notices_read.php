<?php

use App\Controllers\NoticesController;

require '../../vendor/autoload.php';

$controller = new NoticesController();
echo $controller->getNotices();
