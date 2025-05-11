<?php

require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ClinicDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$clinicDao = new ClinicDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, 'id');

if (empty($id)) {

    if (!empty($userData)) {

        $id = $userData->id;

    } else {
        $message->setMessage("Usuário não encontrado! ", 'error', 'index.php');
    }
} else {

    $userData = $userDao->findById($id);

    if (!$userData) {
        $message->setMessage("Usuário não encontrado! ", 'error', 'index.php');
    }
}

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}

$userClinics = $clinicDao->getClicnicByUserId($id);

?>

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?= $fullName ?></h1>
                <div id="profile-image-container" class=".profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
                <h3 class="about-title">Sobre: </h3>
                <?php if (!empty($userData->bio)): ?>
                    <p class="profile-description"><?= $userData->bio ?></p>
                <?php else: ?>
                    <p class="profile-description">O usuário ainda não escreveu nada aqui!</p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 added-clinics-container">
                <h3>Clinicas que cadastrou: </h3>
                <div class="clinic-container">
                    <?php foreach($userClinics as $clinic): ?>
                        <?php require("templates/clinic.php"); ?>
                    <?php endforeach; ?>
                    <?php if (count($userClinics) === 0): ?>
                        <p class="empty-list">O usuário ainda não cadastrou nenhuma clinica</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>