<?php
    include_once "templates/header.php";

    include_once "dao/UserDAO.php";
    include_once "dao/ClinicDAO.php";
    include_once "models/User.php";

    $user    = new User();
    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $clinicDao = new ClinicDAO($conn, $BASE_URL);

    $id = filter_input(INPUT_GET, 'id');

    if (empty($id)) {
        $message->setMessage("Clínica não encontrada.", "error", "index.php");
    } else {

        $clinic = $clinicDao->findById($id);

        if (!$clinic) {
            $message->setMessage("Clínica não encontrada.", "error", "index.php");
        }
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $clinic->title ?></h1>
                <p class="page-description">Altere os dados da clínica no formulário a baixo:</p>
                <form action="<?= $BASE_URL ?>clinic_process.php" id="edit-clinic-form" method="POST" enctype="multipart/form-data"></form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>