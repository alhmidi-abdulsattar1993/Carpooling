<?php

use App\Controllers\BookingsController;
use App\Controllers\CarsController;
use App\Controllers\NoticesController;
use App\Controllers\UsersController;

require_once 'vendor/autoload.php';

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new UsersController();
$users = $controller->getUsers();

$controller = new CarsController();
$cars =  $controller->getCars();

$controller = new UsersController();
$message_create_user = $controller->createUser();

$controller = new NoticesController();
$notices = $controller->getNotices();


$controller = new BookingsController();
$booking = $controller->getBookings();


$controller = new CarsController();
$message_car = $controller->createCar();

echo $twig->render('home.html.twig', [
    'users' => $users,
    'cars'=>$cars,
    'message' => $message_create_user ,
    'notices'=> $notices,
    'booking'=> $booking
]);