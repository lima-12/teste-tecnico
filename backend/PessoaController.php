<?php

/**
 * Classe PessoaController
 * 
 * Responsável por gerenciar o CRUD de pessoas no sistema.
 * Utiliza o arquivo pessoas.json para armazenamento persistente dos dados.
 */
class PessoaController {
    private $filePath = __DIR__ . '/data/pessoas.json';

    /**
     * Funcionalidade - Listagem de Pessoas
     * "3. Listagem."
     * 
     * Lê o arquivo pessoas.json e retorna uma lista de pessoas cadastradas.
     * @return array Lista de pessoas
     */
    public function listar() {
        $pessoas = json_decode(file_get_contents($this->filePath), true);
        return $pessoas ?: [];
    }

    /**
     * Funcionalidade - Cadastro de Pessoas
     * "1. Criação."
     * 
     * Recebe o nome e a idade, cria uma nova pessoa e salva no arquivo pessoas.json.
     * Gera um ID automático baseado no último ID cadastrado.
     * @param string $nome Nome da pessoa
     * @param int $idade Idade da pessoa
     * @return array Dados da pessoa criada
     */
    public function criar($nome, $idade) {
        $pessoas = $this->listar();
        
        $novoId = count($pessoas) > 0 ? end($pessoas)['id'] + 1 : 1;

        $novaPessoa = [
            'id' => $novoId,
            'nome' => $nome,
            'idade' => (int)$idade
        ];

        $pessoas[] = $novaPessoa;
        file_put_contents($this->filePath, json_encode($pessoas, JSON_PRETTY_PRINT));
        
        return $novaPessoa;
    }

    /**
     * Funcionalidade - Deleção de Pessoas
     * "2. Deleção."
     * 
     * Remove uma pessoa do arquivo pessoas.json com base no ID fornecido.
     * Reescreve o arquivo sem a pessoa excluída.
     * @param int $id ID da pessoa a ser deletada
     */
    public function deletar($id) {
        $pessoas = $this->listar();
        $pessoas = array_filter($pessoas, function($pessoa) use ($id) {
            return $pessoa['id'] != $id;
        });
        file_put_contents($this->filePath, json_encode(array_values($pessoas), JSON_PRETTY_PRINT));
    }
}
