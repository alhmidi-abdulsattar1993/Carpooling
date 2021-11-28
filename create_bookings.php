<?php

use App\Controllers\BookingsController;
use App\Services\NoticesService;
use App\Services\UsersService;

require 'vendor/autoload.php';

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new BookingsController();
$messageBookingCreate = $controller->createBooking();

$noticesService = new NoticesService();
$notices = $noticesService->getNotices();

$usersService = new UsersService();
$users = $usersService->getUsers();

foreach ($notices as $notice){
    $noticeText[] = $notice->getText() . ' ' . $notice->getStartCity() . ' -> ' . $notice->getEndCity();
    $noticId[] = $notice->getId();
}


foreach ($users as $user){
    $userName[] =  $user->getFirstname() . ' ' . $user->getLastname();
    $userId[] = $user->getId();
}

echo $twig->render('booking_creat.html.twig', [
    'userName' => $userName,
    'userId' => $userId,
    'noticeText'=> $noticeText,
    'noiceId'=> $noticId,
    'message'=> $messageBookingCreate
]);


