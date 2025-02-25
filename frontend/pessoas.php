<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<link rel="stylesheet" href="assets/style/index.css">

<body>

    <?php require_once 'components/header.php' ?> 
    <br><br>

    <div class="banners container mt-5">
        <h2>Cadastro de Pessoas</h2>
        <form id="formPessoa">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" required>
            </div>
            <div class="mb-3">
                <label for="idade" class="form-label">Idade:</label>
                <input type="number" class="form-control" id="idade" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>

        <h3 class="mt-5">Pessoas Cadastradas:</h3>
        <ul id="listaPessoas" class="list-group"></ul>
    </div>

    <?php require_once 'components/footer.php' ?>

    <!-- bloco de codigo com as funcoes relacionadas com o backend -->
    <?php require_once 'assets/js/pessoas.php' ?>

</body>
</html>
