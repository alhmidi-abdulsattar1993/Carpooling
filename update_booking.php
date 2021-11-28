<?php

use App\Controllers\BookingsController;
use App\Services\NoticesService;
use App\Services\UsersService;

require 'vendor/autoload.php';

$controller = new BookingsController();
$messageBookingupdate = $controller->updateBooking();

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

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

echo $twig->render('bookingUpdate.html.twig', [
    'userName' => $userName,
    'userId' => $userId,
    'noticeText'=> $noticeText,
    'noiceId'=> $noticId,
    'message'=> $messageBookingupdate
]);



