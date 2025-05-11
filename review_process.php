<?php

require_once('globals.php');
require_once('db.php');
require_once("models/Clinic.php");
require_once("models/Review.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ClinicDAO.php");
require_once("dao/ReviewDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$clinicDao = new ClinicDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, 'type');

$userData = $userDao->verifyToken();

if ($type === 'create') {
    $rating = filter_input(INPUT_POST, 'rating');
    $review = filter_input(INPUT_POST, 'review');
    $clinics_id = filter_input(INPUT_POST, 'clinics_id');
    $users_id = $userData->id;

    $reviewObject = new Review();

    $clinicData = $clinicDao->findById($clinics_id);

    if ($clinicData) {

        if (!empty($rating) && !empty($review) && !empty($clinics_id)) {

            $reviewObject->rating = $rating;
            $reviewObject->review = $review;
            $reviewObject->clinics_id = $clinics_id;
            $reviewObject->users_id = $users_id;

            $reviewDao->create($reviewObject);

        } else {
            $message->setMessage("Você precisa adicionar a nota e o comentário! ", 'error', 'back');
        }

    } else {
        $message->setMessage("Informações inválidas! ", 'error', 'index.php');
    }

} else {
    $message->setMessage("Informações inválidas! ", 'error', 'index.php');
}

?>