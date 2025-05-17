<?php
    require_once("templates/header.php");

    // Verifica se usuário está autenticado
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    require_once("dao/ClinicDAO.php");

    $user = new User();
    $userDao = new UserDao($conn, $BASE_URL);
    $clinicDao = new ClinicDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $clinicUser = $clinicDao->getClicnicByUserId($userData->id);
?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações das clínicas que você enviou</p>
    <div class="col-md-12" id="add-clinic-container">
      <a href="<?= $BASE_URL ?>newclinic.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Clínica
      </a>
    </div>

    <div class="col-md-12" id="clinics-dashboard">
        <table class="table">
            <thead>
                <th scope="Col">#</th>
                <th scope="Col">Título</th>
                <th scope="Col">Nota</th>
                <th scope="Col" class="actions-column">Ações</th>
            </thead>
            <tbody>
                <?php foreach ($clinicUser as $clinic): ?>
                <tr>
                    <td scope="row"><?= $clinic->id ?></td>
                    <td><a href="<?= $BASE_URL ?>clinic.php?id=<?= $clinic->id ?>" class="table-clinic-title"><?= $clinic->title ?></a></td>
                    <td><i class="fas fa-star"></i> <?= $clinic->rating ?></td>
                    <td class="actions-column">
                        <a href="<?= $BASE_URL ?>editclinic.php?id=<?= $clinic->id ?>" class="edit-btn"><i class="far fa-edit"></i>
                            Editar
                        </a>
                        <form action="<?= $BASE_URL ?>clinic_process.php" method="POST">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $clinic->id ?>">
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-times"></i> Deletar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    include_once "templates/footer.php";
?>