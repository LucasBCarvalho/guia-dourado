<?php
    include_once "templates/header.php";
    include_once "dao/ClinicDAO.php";

    $clinicDAO = new ClinicDAO($conn, $BASE_URL);

    $latestClinics            = $clinicDAO->getLastClinics();
    $categoryOneClinics       = $clinicDAO->getClinicByCategory("1");;
    $categoryOneAndTwoClinics = $clinicDAO->getClinicByCategory("4");;
    $allCategorysClinics      = $clinicDAO->getClinicByCategory("7");;
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Novas Clínicas</h2>
    <p class="section-description">Veja as críticas das últimas clínicas adicionadas</p>
    <div class="clinic-container">
        <?php foreach ($latestClinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
        <?php if (count($latestClinics) === 0): ?>
            <p class="empty-list">Ainda não há clínicas aqui!</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Clínicas de Categoria 1</h2>
    <p class="section-description">Veja as melhores clínicas para idosos categoria 1</p>
    <div class="clinic-container">
        <?php foreach ($categoryOneClinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
        <?php if (count($categoryOneClinics) === 0): ?>
            <p class="empty-list">Ainda não há clínicas aqui!</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Clínicas de Categoria 1 e 2</h2>
    <p class="section-description">Veja as melhores clínicas para idosos categoria 1 e 2</p>
    <div class="clinic-container">
        <?php foreach ($categoryOneAndTwoClinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
        <?php if (count($categoryOneAndTwoClinics) === 0): ?>
            <p class="empty-list">Ainda não há clínicas aqui!</p>
        <?php endif; ?>
    </div>
    <h2 class="section-title">Clínicas de todas as Categorias</h2>
    <p class="section-description">Veja as melhores clínicas para idosos de todas as categorias</p>
    <div class="clinic-container">
        <?php foreach ($allCategorysClinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
        <?php if (count($allCategorysClinics) === 0): ?>
            <p class="empty-list">Ainda não há clínicas aqui!</p>
        <?php endif; ?>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>