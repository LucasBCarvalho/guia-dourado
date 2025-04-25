<?php 
    include_once "templates/header.php";
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Novas Clínicas</h2>
    <p class="section-description">Veja as críticas das últimas clínicas adicionadas</p>
    <div class="clinic-container">
        <div class="card clinic-card">
            <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/clinics/clinics_cover.jpg')"></div>
                <div class="card-body">
                    <p class="card-rating">
                        <i class="fas fa-star"></i>
                        <span class="rating">9</span>
                    </p>
                    <h5 class="card-title">
                        <a href="#">Título da Clínica</a>
                    </h5>
                    <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
                    <a href="#" class="btn btn-primary card-btn">Conhecer</a>
                </div>
            </div>
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