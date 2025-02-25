<?php

require_once 'PessoaController.php';

class TransacaoController {
    private $filePath = __DIR__ . '/data/transacoes.json';
    private $pessoaController;

    public function __construct() {
        $this->pessoaController = new PessoaController();
    }

    /**
     * * Funcionalidade - Listagem de Transacoes
     * "6. Deleção."
     * Lista todas as transações cadastradas.
     * @return array Lista de transações ou array vazio.
     */
    public function listar() {
        $transacoes = json_decode(file_get_contents($this->filePath), true);
        return $transacoes ?: [];
    }

    /**     
     * Funcionalidade - Cadastro de Transacoes
     * "5. Criacaoo."
     * Cadastra uma nova transação.
     * 7. Caso o usuario informe um menor de idade (menor de 18), apenas despesas deverão ser aceitas.
     * @param string $descricao
     * @param float $valor
     * @param string $tipo ("receita" ou "despesa")
     * @param int $pessoaId
     * @return array Nova transação ou mensagem de erro.
     */
    public function criar($descricao, $valor, $tipo, $pessoaId) {
        $pessoas = $this->pessoaController->listar();

        // Verifica se a pessoa existe
        $pessoa = array_filter($pessoas, fn($p) => $p['id'] == $pessoaId);
        if (!$pessoa) {
            return ['erro' => 'Pessoa não encontrada!'];
        }

        $pessoa = array_values($pessoa)[0];

        // Se a pessoa for menor de idade, só pode cadastrar despesas
        if ($pessoa['idade'] < 18 && $tipo === 'receita') {
            return ['erro' => 'Menor de idade só pode cadastrar despesas!'];
        }

        $transacoes = $this->listar();
        $novoId = count($transacoes) > 0 ? end($transacoes)['id'] + 1 : 1;

        $novaTransacao = [
            'id' => $novoId,
            'descricao' => $descricao,
            'valor' => (float)$valor,
            'tipo' => $tipo,
            'pessoaId' => (int)$pessoaId
        ];

        $transacoes[] = $novaTransacao;
        file_put_contents($this->filePath, json_encode($transacoes, JSON_PRETTY_PRINT));

        return $novaTransacao;
    }

    /**
     * Deleta uma transação pelo ID.
     * @param int $id ID da transação a ser deletada.
     */
    public function deletar($id) {
        $transacoes = $this->listar();
        $transacoes = array_filter($transacoes, function($transacao) use ($id) {
            return $transacao['id'] != $id;
        });
        file_put_contents($this->filePath, json_encode(array_values($transacoes), JSON_PRETTY_PRINT));
    }

    /**
     * Deleta todas as transações associadas a uma pessoa específica.
     * @param int $pessoaId ID da pessoa cujas transações serão removidas.
     */
    public function deletarTransacoesPessoa($pessoaId) {
        $transacoes = $this->listar();
        $transacoes = array_filter($transacoes, function($transacao) use ($pessoaId) {
            return $transacao['pessoaId'] != $pessoaId;
        });
        file_put_contents($this->filePath, json_encode(array_values($transacoes), JSON_PRETTY_PRINT));
    }
}
