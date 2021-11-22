<?php

use App\Controllers\BookingsController;

require '../../vendor/autoload.php';

$controller = new BookingsController();
echo $controller->deleteBooking();

//$usersService = new UsersService();
//$users = $usersService->getUsers();
?>

<p>Supression d'une réservation</p>
<form method="post" action="bookings_delete.php" name ="bookingDeleteForm">
    <label for="id_booking">Id réservation:</label>
    <input type="text" name="id_booking">
    <br />
    <input type="submit" value="Supprimer une réservation">
</form>