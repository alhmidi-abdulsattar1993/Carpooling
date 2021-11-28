<?php
 

require_once 'vendor/autoload.php';
use App\Controllers\CarsController;

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);



$controller = new CarsController();
$message_create_car = $controller->createCar();


echo $twig->render('formCarCreate.html.twig', [
    'message'=> $message_create_car
    
]);

