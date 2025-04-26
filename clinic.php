<?php

    include_once "templates/header.php";

    include_once "dao/ClinicDAO.php";
    include_once "models/Clinic.php";
    include_once "models/Message.php";

    $id = filter_input(INPUT_GET, "id");

    $clinic;

    $clinicDao = new ClinicDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);

    if (empty($id)) {
        $message->setMessage("Clínica não encontrada.", "error", "index.php");
    } else {

        $clinic = $clinicDao->findById($id);

        if (!$clinic) {
            $message->setMessage("Clínica não encontrada.", "error", "index.php");
        }
    }

    $userOwnsClinic = false;

    if (!empty($userData)) {
        if ($userData->id === $clinic->users_id) {
            $userOwnsClinic = true;
        }
    }

?>