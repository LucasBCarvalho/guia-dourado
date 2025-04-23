<?php

require_once('globals.php');
require_once('db.php');
require_once("models/Clinic.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ClinicDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$clinicDao = new ClinicDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, 'type');

$userData = $userDao->verifyToken();

if ($type === 'create') {

    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $trailer = filter_input(INPUT_POST, 'trailer');
    $category = filter_input(INPUT_POST, 'category');
    $length = filter_input(INPUT_POST, 'length');

    $clinic = new Clinic();

    if (!empty($title) && !empty($description) && !empty($category)) {
        
        $clinic->title = $title;
        $clinic->description = $description;
        $clinic->trailer = $trailer;
        $clinic->category = $category;
        $clinic->length = $length;

        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {

            $image      = $_FILES['image'];
            $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            $jpgArray   = ['image/jpeg', 'image/jpg'];
            
            if (in_array($image['type'], $imageTypes)) {
                if (in_array($image['type'], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image['tmp_name']);
                } else {
                    $imageFile = imagecreatefrompng($image['tmp_name']);
                }
    
                $imageName = $clinic->imageGenerateName();
                imagejpeg($imageFile, './img/users/' . $imageName, 100);
    
                $clinic->image = $imageName;
    
            } else {
                $message->setMessage("Tipo de imagem inválida, insira png ou jpg!", 'error', 'back');
            }
        }

        if ($message->getMessage() == false) {
            $clinicDao->create($clinic);
        }

    } else {
        $message->setMessage("Você precisa preencher pelo menos: título, descrição e categoria! ", 'error', 'back');
    }

} else {
    $message->setMessage("Informações inválidas!", 'error', 'index.php');
}