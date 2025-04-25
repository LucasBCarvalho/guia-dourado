<?php 
    include_once "templates/header.php";

    include_once "dao/UserDAO.php";
    include_once "models/User.php";

    $userDao = new UserDAO($conn, $BASE_URL);
    $user    = new User();

    $userData = $userDao->verifyToken(true);
    $fullName = $user->getFullName($userData);
?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-clinic-container">
        <h1 class="page-title">Adicionar Clínica</h1>
        <p class="page-description">
            Adicione sua crítica e compartilhe sobre o que achou dessa clínica:
        </p>
        <form action="<?= $BASE_URL ?>clinic_process.php" id="add-clinic-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Nome da Clínica:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome da clínica">
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="length">Tempo de Operação:</label>
                <input type="text" class="form-control" id="length" name="length" placeholder="Digite há quanto tempo essa casa de idosos existe">
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">-- Selecionar categoria --</option>
                    <option value="Idosos categoria 1">Somente Idosos da Categoria 1</option>
                    <option value="Idosos categoria 1 e 2">Idosos das Categorias 1 e 2</option>
                    <option value="Idosos de todas as categorias">Idosos de Todas as Categorias</option>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva sobre a clínica..."></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar Clínica">
        </form>
    </div>
</div>
    
<?php 
    include_once "templates/footer.php";
?>