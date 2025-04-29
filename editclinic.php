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

    if ($clinic->image == '') {
        $clinic->image = "clinics_cover.jpg";
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $clinic->title ?></h1>
                <p class="page-description">Altere os dados da clínica no formulário a baixo:</p>
                <form action="<?= $BASE_URL ?>clinic_process.php" id="edit-clinic-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $clinic->id ?>">
                    <div class="form-group">
                        <label for="title">Nome da Clínica:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome da clínica" value="<?= $clinic->title ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="length">Tempo de Operação:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Digite há quanto tempo essa casa de idosos existe" value="<?= $clinic->length ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">-- Selecionar categoria --</option>
                            <option value="1" <?= $clinic->category === "1" ? "selected" : "" ?> >Somente Idosos da Categoria 1</option>
                            <option value="2" <?= $clinic->category === "2" ? "selected" : "" ?> >Somente Idosos da Categoria 2</option>
                            <option value="3" <?= $clinic->category === "3" ? "selected" : "" ?> >Somente Idosos da Categoria 3</option>
                            <option value="4" <?= $clinic->category === "4" ? "selected" : "" ?> >Idosos das Categorias 1 e 2</option>
                            <option value="5" <?= $clinic->category === "5" ? "selected" : "" ?> >Idosos das Categorias 1 e 3</option>
                            <option value="6" <?= $clinic->category === "6" ? "selected" : "" ?> >Idosos das Categorias 2 e 3</option>
                            <option value="7" <?= $clinic->category === "7" ? "selected" : "" ?> >Idosos de Todas as Categorias</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer:</label>
                        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $clinic->trailer ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva sobre a clínica..."><?= $clinic->description ?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Adicionar Clínica">
                </form>
            </div>
            <div class="col-md-3">
                <div class="clinic-image-container" style="background-image: url('<?= $BASE_URL ?>img/clinics/<?= $clinic->image ?>') "></div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>