<?php 
    include_once "templates/header.php";
    include_once "dao/ClinicDAO.php";

    $clinicDAO = new ClinicDAO($conn, $BASE_URL);

    $latestClinics = $clinicDAO->getLastClinics();
    $categoryOneClinics       = array();
    $categoryOneAndTwoClinics = array();
    // $allCategorysClinics = array();
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Novas Clínicas</h2>
    <p class="section-description">Veja as críticas das últimas clínicas adicionadas</p>
    <div class="clinic-container">
        <?php foreach ($latestClinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
    </div>
    <h2 class="section-title">Clínicas de Categoria 1</h2>
    <p class="section-description">Veja as melhores clínicas para idosos categoria 1</p>
    <div class="clinic-container">

    </div>
    <h2 class="section-title">Clínicas de Categoria 1 e 2</h2>
    <p class="section-description">Veja as melhores clínicas para idosos categoria 1 e 2</p>
    <div class="clinic-container">

    </div>
</div>

<?php
    include_once "templates/footer.php";
?>