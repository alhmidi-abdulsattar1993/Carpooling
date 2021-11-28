<?php

use App\Controllers\BookingsController;

require 'vendor/autoload.php';

$controller = new BookingsController();
$message_delete_booking = $controller->deleteBooking();

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

echo $twig->render('bookingDelete.html.twig', [
    'message'=> $message_delete_booking 
]);

?>

