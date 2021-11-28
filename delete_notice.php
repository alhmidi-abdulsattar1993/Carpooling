<?php

use App\Controllers\NoticesController;

require 'vendor/autoload.php';

$loader = new Twig_loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);

$controller = new NoticesController();
$message_delete_notice = $controller->deleteNotice();

echo $twig->render('noticeDelete.html.twig', [
    'message'=> $message_delete_notice
    
]);
