<?php

use App\Controllers\UsersController;

require '../../vendor/autoload.php';

$controller = new UsersController();
echo $controller->getUsers();
