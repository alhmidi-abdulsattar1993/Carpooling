<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';
$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new CarsController();
$message_car_update = $controller->updateCar();

echo $twig->render('carUpdate.html.twig', [
    'message'=>$message_car_update 
]);