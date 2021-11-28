<?php

use App\Controllers\NoticesController;
use App\Services\UsersService;

require 'vendor/autoload.php';

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new NoticesController();
$messageNoticeUpdate = $controller->updateNotice();

$usersService = new UsersService();
$users = $usersService->getUsers();

foreach ($users as $user){
    $userName[] =  $user->getFirstname() . ' ' . $user->getLastname();
    $userId[] = $user->getId();
}

echo $twig->render('noticeUpdate.html.twig', [
    'userName' => $userName,
    'userId' => $userId,
    'message'=> $messageNoticeUpdate
]);
