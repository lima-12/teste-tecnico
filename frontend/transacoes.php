<?php

require_once '../backend/PessoaController.php';

$pessoaController = new PessoaController();

$pessoas = $pessoaController->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Transações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<link rel="stylesheet" href="assets/style/index.css">

<body>

    <?php require_once 'components/header.php' ?>

    <div class="banners container mt-5">
        <h2>Cadastro de Transações</h2>
        <form id="formTransacao">
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" id="descricao" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input type="number" step="0.01" class="form-control" id="valor" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <select class="form-select" id="tipo" required>
                    <option value="despesa">Despesa</option>
                    <option value="receita">Receita</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pessoaId" class="form-label">Pessoa</label>
                <select class="form-select" id="pessoaId" required>
                    <option value=""> Selecione uma Pessoa </option>
                    <?php foreach ($pessoas as $pessoa): ?>
                        <option value="<?=$pessoa['id']?>"> id: <?= $pessoa['id'] . ' - ' .$pessoa['nome']?> </option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>

        <h3 class="mt-5">Transações Cadastradas:</h3>
        <ul id="listaTransacoes" class="list-group"></ul>

    </div>

    <?php require_once 'components/footer.php' ?>

    <?= require_once 'assets/js/transacoes.php' ?>
</body>
</html>
