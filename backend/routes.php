<?php

require_once 'PessoaController.php';
require_once 'TransacaoController.php';

header('Content-Type: application/json');

$controller = new PessoaController();
$transacaoController = new TransacaoController();

$method = $_SERVER['REQUEST_METHOD'];
$route = $_GET['route'] ?? '';
// exit($route);

// rotas de pessoas
if ($route == 'pessoas') {
    if ($method === 'GET') {
        echo json_encode($controller->listar());
    } elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['nome']) && isset($data['idade'])) {
            echo json_encode($controller->criar($data['nome'], $data['idade']));
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos']);
        }
    } elseif ($method === 'DELETE') {
        if (isset($_GET['id'])) {
            $controller->deletar($_GET['id']);
            $transacaoController->deletarTransacoesPessoa($_GET['id']);
            echo json_encode(['status' => 'Pessoa deletada junto com sua transações!']);
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'ID não informado']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido']);
    }
}

// rotas de transacoes
if ($route == 'transacoes') {
    if ($method === 'GET') {
        echo json_encode($transacaoController->listar());
    } elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['descricao'], $data['valor'], $data['tipo'], $data['pessoaId'])) {
            echo json_encode($transacaoController->criar(
                $data['descricao'],
                $data['valor'],
                $data['tipo'],
                $data['pessoaId']
            ));
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos']);
        }
    } elseif ($method === 'DELETE') {
        if (isset($_GET['id'])) {
            $transacaoController->deletar($_GET['id']);
            echo json_encode(['status' => 'Transacao deletada com sucesso']);
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'ID não informado']);
        } 
    } else {
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido']);
    }
}