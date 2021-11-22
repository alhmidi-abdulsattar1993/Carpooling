<?php

use App\Controllers\NoticesController;
use App\Services\UsersService;

require '../../vendor/autoload.php';

$controller = new NoticesController();
echo $controller->createNotice();

$usersService = new UsersService();
$users = $usersService->getUsers();
?>

<p>Création d'une annonce</p>
<form method="post" action="notices_create.php" name ="noticeCreateForm">
    <label for="text">Description :</label>
    <input type="text" name="text">
    <br />
    <label for="start_city">Départ de :</label>
    <input type="text" name="start_city">
    <br />
    <label for="end_city">Arrivée à :</label>
    <input type="text" name="end_city">
    <br />
	<label for="users">Créateur de l'annonce :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname(); ?>
        <input type="radio" name="user_creator_id" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce">
</form>