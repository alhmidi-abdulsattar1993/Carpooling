<?php

use App\Controllers\BookingsController;

require '../../vendor/autoload.php';

$controller = new BookingsController();
echo $controller->updateBooking();
?>

<p>Mise à jour d'une réservation</p>
<form method="post" action="bookings_update.php" name ="bookingUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id_booking">
    <br />
    <label for="start_day">Date de réservation au format dd-mm-yyyy :</label>
    <input type="text" name="start_day">
    <br />
    <label for="notice">id notice :</label>
    <input type="text" name="notice_id">
    <br />
    <label for="user">Utilisateur passager :</label>
    <input type="text" name="user_id">
    <br />
    <input type="submit" value="Modifier la réservation">
</form>