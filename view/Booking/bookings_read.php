<?php

use App\Controllers\BookingsController;

require '../../vendor/autoload.php';

$controller = new BookingsController();
echo $controller->getBookings();
