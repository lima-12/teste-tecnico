<?php

require_once '../backend/PessoaController.php';
require_once '../backend/TransacaoController.php';

$pessoaController = new PessoaController();
$transacaoController = new TransacaoController();

$pessoas = $pessoaController->listar();
$transacoes = $transacaoController->listar();

$totalReceitas = 0;
$totalDespesas = 0;

/**
 * Funcionalidade - Consulta de Totais
 * "9. Ao final da listagem anterior, deverá exibir o total geral de todas as pessoas, incluindo o total de receitas, total de despesas e o saldo líquido."
 * 
 * Esse foreach tem o intuito de verificar todas as transacoes pra chegar nos resultados totais.
 * se a transacao for do tipo receita eu vou acrescentar na variavel $totalReceitas, senão vou acrescentar na variavel $totalDespesas
 * por fim, eu somo essas 2 variaveis pra chegar na variavel $saldoGeral
 */
foreach ($transacoes as $transacao) {
    if ($transacao['tipo'] === 'receita') {
        $totalReceitas += $transacao['valor'];
    } else {
        $totalDespesas += $transacao['valor'];
    }
}

$saldoGeral = $totalReceitas - $totalDespesas;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Controle de Gastos Residenciais</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<link rel="stylesheet" href="assets/style/index.css">

<body>

    <?php require_once 'components/header.php' ?> 
    <br><br>

    <div class="banners container mt-5">
        <!-- Botões de navegação -->
        <div class="d-flex justify-content-between my-5">
            <h1>Controle de Gastos Residenciais</h1>
            <div>
                <a href="pessoas.php" class="btn btn-secondary my-2"> <i class="bi bi-plus-circle"></i> Cadastrar Pessoa</a>
                <a href="transacoes.php" class="btn btn-secondary my-2"> <i class="bi bi-plus-circle"></i> Cadastrar Transação</a>
            </div>
        </div>

        <!-- Cards de totais gerais -->
        <div class="row mb-4 my-2">
            <div class="col-md-4 my-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total de Receitas</h5>
                        <p class="card-text">R$ <?= number_format($totalReceitas, 2, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total de Despesas</h5>
                        <p class="card-text">R$ <?= number_format($totalDespesas, 2, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Líquido</h5>
                        <p class="card-text">R$ <?= number_format($saldoGeral, 2, ',', '.') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de pessoas e transações -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Total de Receitas</th>
                    <th>Total de Despesas</th>
                    <th>Saldo</th>
                    <th>Transações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pessoas as $pessoa):
                /**
                 * Funcionalidade - Consulta de Totais
                 * "8. Deverá listar todas as pessoas cadastradas, exibindo o total de receitas, despesas e o saldo (receita – despesa) de cada uma."
                 * 
                 * Diferente do primeiro foreach, do começo da pagina, esse aqui tem o intuito de pegas as transacoes das pessoas separadamente
                 * 
                 * Dito isso, iterando a listagem de $pessoas, pra pegar cada pessoa individualmente, eu vou iterar a listagem de $transacoes procurando o id da pessoa
                 * atual, para entao encontrar as transacoes daquela determinada pessoa e realizar os somatórios.
                 * 
                 * Se o id da pessoa da lista de pessoas for igual ao pessoaId da lista de transacoes, significa que aquela transacao pertence a aquela pessoa.
                 * 
                 * Apos essa verificacao, eu vejo o tipo da transacao, se for receita eu eu vou acrescentar na variavel $receitasPessoa, senão vou acrescentar na variavel $despesasPessoa
                 * por fim, eu somo essas 2 variaveis pra chegar na variavel $saldoPessoa
                 * 
                 * ! foi a forma que encontrei pra simular um relacionamento no banco de dados !
                 */
                    $receitasPessoa = 0;
                    $despesasPessoa = 0;
                    foreach ($transacoes as $transacao) {
                        if ($transacao['pessoaId'] == $pessoa['id']) {
                            if ($transacao['tipo'] === 'receita') {
                                $receitasPessoa += $transacao['valor'];
                            } else {
                                $despesasPessoa += $transacao['valor'];
                            }
                        }
                    }
                    $saldoPessoa = $receitasPessoa - $despesasPessoa;
                ?>
                    <tr>
                        <td><?=$pessoa['id']?></td>
                        <td><?= htmlspecialchars($pessoa['nome']) ?></td>
                        <td>R$ <?= number_format($receitasPessoa, 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($despesasPessoa, 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($saldoPessoa, 2, ',', '.') ?></td>
                        <td>
                            <?php foreach ($transacoes as $transacao):
                                if ($transacao['pessoaId'] == $pessoa['id'] && $transacao['tipo'] === 'receita'):
                                    echo "<span class='badge bg-success'>{$transacao['descricao']} - R$ ".number_format($transacao['valor'], 2, ',', '.')."</span> <i class='bi bi-arrow-up-circle-fill text-success'></i> <br>";
                                elseif ($transacao['pessoaId'] == $pessoa['id'] && $transacao['tipo'] === 'despesa'):
                                    echo "<span class='badge bg-danger'>{$transacao['descricao']} - R$ ".number_format($transacao['valor'], 2, ',', '.')."</span> <i class='bi bi-arrow-down-circle-fill text-danger'></i> <br>";
                                endif;
                            endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require_once 'components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
