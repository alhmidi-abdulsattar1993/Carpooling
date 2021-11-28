<?php

use App\Controllers\UsersController;
use App\Services\CarsService;

require 'vendor/autoload.php';


$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new UsersController();
$message_user_update  = $controller->updateUser();

$carsService = new CarsService();
$cars = $carsService->getCars();

foreach ($cars as $car){
    $carName[] =  $car->getBrand();
    $carBrand =  $car->getModel();
    $carColor =$car->getColor();
    $carId[] = $car->getId();
}

echo $twig->render('userUpdate.html.twig', [
    'message'=>$message_user_update,
    'carName' => $carName,
    'carId' => $carId
]);

