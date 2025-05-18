<?php
    include_once "templates/header.php";
    include_once "dao/ClinicDAO.php";

    $clinicDAO = new ClinicDAO($conn, $BASE_URL);

    $q = filter_input(INPUT_GET, 'q');

    $clinics = $clinicDAO->findByTitle($q);
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca encontrados com base na pesquisa.</p>
    <div class="clinic-container">
        <?php foreach ($clinics as $clinic): ?>
            <?php require("templates/clinic.php"); ?>
        <?php endforeach; ?>
        <?php if (count($clinics) === 0): ?>
            <p class="empty-list">Não existem clínicas para essa busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a></p>
        <?php endif; ?>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>