<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new CarsController;
$message_delete_car =  $controller->deleteCar();

echo $twig->render('carDelete.html.twig', [
    'message'=> $message_delete_car
    
]);
