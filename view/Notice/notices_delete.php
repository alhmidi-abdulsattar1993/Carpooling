<?php

use App\Controllers\NoticesController;

require '../../vendor/autoload.php';

$controller = new NoticesController();
echo $controller->deleteNotice();
?>

<p>Supression d'une annonce</p>
<form method="post" action="notices_delete.php" name ="noticeDeleteForm">
    <label for="id_notice">Id annonce:</label>
    <input type="text" name="id_notice">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>