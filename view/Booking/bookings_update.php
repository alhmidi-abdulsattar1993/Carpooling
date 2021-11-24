<?php

use App\Controllers\BookingsController;
use App\Services\NoticesService;
use App\Services\UsersService;

require '../../vendor/autoload.php';

$controller = new BookingsController();
echo $controller->updateBooking();

$noticesService = new NoticesService();
$notices = $noticesService->getNotices();

$usersService = new UsersService();
$users = $usersService->getUsers();
?>

<p>Mise à jour d'une réservation</p>
<form method="post" action="bookings_update.php" name ="bookingUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id_booking">
    <br />
    <label for="start_day">Date de réservation au format dd-mm-yyyy :</label>
    <input type="text" name="start_day">
    <br />
    <label for="notice">Annonce(s) :</label>
    <?php foreach ($notices as $notice): ?>
        <?php $noticeText = 'Id_notice = ' . $notice->getId() . ' ' . $notice->getText() . ' ' . $notice->getStartCity() . ' -> ' . $notice->getEndCity(); ?>
        <input type="radio" name="notice_id" value="<?php echo $notice->getId(); ?>"><?php echo $noticeText; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="users">Passager(s) :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <input type="submit" value="Modifier la réservation">
</form>