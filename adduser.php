<?php 

require_once 'vendor/autoload.php';


$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

use App\Services\CarsService;

$carsService = new CarsService();
$cars = $carsService->getCars();

foreach ($cars as $car){
    $carName[] =  $car->getBrand();
    $carBrand =  $car->getModel();
    $carColor =$car->getColor();
    $carId[] = $car->getId();
}

echo $twig->render('formUserCreate.html.twig', [
    'carName' => $carName,
    'carId' => $carId
]);