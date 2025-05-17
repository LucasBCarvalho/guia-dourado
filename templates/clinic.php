<?php

    if (empty($clinic->image)) {
        $clinic->image = "clinics_cover.jpg";
    }

?>

<div class="card clinic-card">
    <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/clinics/<?= $clinic->image ?>')"></div>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i>
            <span class="rating"> <?= $clinic->rating ?> </span>
        </p>
        <h5 class="card-title">
            <a href="<?= $BASE_URL ?>clinic.php?id=<?= $clinic->id ?>"><?= $clinic->title ?></a>
        </h5>
        <a href="<?= $BASE_URL ?>clinic.php?id=<?= $clinic->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
        <a href="<?= $BASE_URL ?>clinic.php?id=<?= $clinic->id ?>" class="btn btn-primary card-btn">Conhecer</a>
    </div>
</div>