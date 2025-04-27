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

    if($clinic->image == "") {
        $clinic->image = "clinic_cover.jpg";
    }

    $userOwnsClinic = false;

    if (!empty($userData)) {
        if ($userData->id === $clinic->users_id) {
            $userOwnsClinic = true;
        }
    }

?>
<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 clinics-container">
            <h1 class="page-title"><?= $clinic->title ?></h1>
            <p class="clinic-details">
                <span>Duração: <?= $clinic->length ?></span>
                <span class="pipe"></span>
                <span><?= $clinic->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> 9</span>
            </p>
            <iframe src="<?= $clinic->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?= $clinic->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="clinic-image-container" style="background-image: url('<?= $BASE_URL ?>img/clinics/<?= $clinic->image ?>')"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <div class="col-md-12" id="review-form-container">
                <h4>Envie sua avaliação:</h4>
                <p class="page-description">Preencha o formulário com a nota e comentário sobre a clínica</p>
                <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="clinics_id" value="<?= $clinic->id ?>">
                    <div class="form-group">
                        <label for="rating">Nota da clínica:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Selecione</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Seu comentário:</label>
                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou da clínica?"></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Enviar comentário">
                </form>
            </div>
            <div class="col-md-12 review">
                <div class="row">
                    <div class="col-md-1">
                        <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/user.png')"></div>
                    </div>
                    <div class="col-md-9 author-details-container">
                        <h4 class="author-name">
                            <a href="#">Lucas</a>
                        </h4>
                        <p><i class="fas fa-star"></i> 9</p>
                    </div>
                    <div class="col-md-12">
                        <p class="comment-title">Comentário:</p>
                        <p>Este é o comentario do usuário</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

