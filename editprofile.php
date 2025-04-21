<?php 
    include_once "templates/header.php";
    include_once "dao/UserDAO.php";
    include_once "models/User.php";

    $userDao = new UserDAO($conn, $BASE_URL);
    $user    = new User();

    $userData = $userDao->verifyToken(true);
    $fullName = $user->getFullName($userData);

    if ($userData->image == '') {
        $userData->image = "user.png";
    }
?>

<div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
        <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $fullName ?></h1>
                    <p class="page-description">Altere seus dados no formulário abaixo:</p>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Digite seu nome" value="<?= $userData->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobreome:</label>
                        <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" readonly id="email" class="form-control disabled" name="email" placeholder="Digite seu nome" value="<?= $userData->email ?>">
                    </div>
                    <input type="submit" class="btn card-btn" value="Alterar">
                </div>
                <div class="col-md-4">
                    <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" id="image" class="form-control-file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="bio">Sobre você:</label>
                        <textarea name="bio" id="bio" class="form-control" rows="5" placeholder="Conte que é você, o que faz e onde trabalha..."><?= $userData->bio ?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="change-password-container" class="row">
        <div class="col-md-4">
            <h2>Alterar Senha</h2>
            <p class="page-description">Digite a nova senha e confirme, para alterar sua senha:</p>
            <form action="<?= $BASE_URL ?>user_process.php" method="POST">
                <input type="hidden" name="type" value="changepassword">
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Digite a sua nova senha">
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirmação de senha:</label>
                    <input type="password" id="confirmpassword" class="form-control" name="confirmpassword" placeholder="Confirme a sua nova senha">
                </div>
                <input type="submit" class="btn card-btn" value="Alterar Senha">
            </form>
        </div>
    </div>
</div>
    
<?php 
    include_once "templates/footer.php";
?>