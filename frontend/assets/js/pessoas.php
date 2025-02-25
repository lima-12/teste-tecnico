<script>
    /**
     * Funcionalidade - Cadastro de Pessoas
     * "1. Criação."
     * 
     * Essa função é acionada quando o formulário de cadastro de pessoas é enviado.
     * Ela coleta os dados do formulário, faz uma requisição POST para a rota de pessoas
     * e, em caso de sucesso, recarrega a lista de pessoas e reseta o formulário.
     */
    document.getElementById('formPessoa').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nome = document.getElementById('nome').value;
        const idade = document.getElementById('idade').value;

        const response = await fetch('../../backend/routes.php?route=pessoas', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nome, idade })
        });

        if (response.ok) {
            carregarPessoas();
            document.getElementById('formPessoa').reset();
        } else {
            alert('Erro ao cadastrar pessoa!');
        }
    });

    /**
     * Funcionalidade - Listagem de Pessoas
     * "3. Listagem."
     * 
     * A função 'carregarPessoas' busca a lista de pessoas no backend
     * e exibe os dados na interface, criando elementos HTML dinamicamente.
     */
    async function carregarPessoas() {
        const response = await fetch('../../backend/routes.php?route=pessoas');
        const pessoas = await response.json();
        const lista = document.getElementById('listaPessoas');
        lista.innerHTML = '';

        pessoas.forEach(pessoa => {
            lista.innerHTML += `<li class="list-group-item">
                Id ${pessoa.id} - ${pessoa.nome} (Idade: ${pessoa.idade}) 
                <button onclick="deletarPessoa(${pessoa.id})" class="btn btn-danger btn-sm float-end">Excluir</button>
            </li>`;
        });
    }

    /**
     * Funcionalidade - Deleção de Pessoas
     * "2. Deleção." e "4. Em casos que se delete uma pessoa, todas as transações dessa pessoa deverão ser apagadas."
     * 
     * A função 'deletarPessoa' solicita a confirmação do usuário,
     * envia uma requisição DELETE para remover a pessoa do backend junto de suas transacoes
     * Por fim, recarrega a listagem de pessoas ao concluir.
     */
    async function deletarPessoa(id) {
        if (confirm('Tem certeza que deseja deletar essa pessoa? \nTodas as transações dessa pessoa serão apagas.')) {
            await fetch(`../../backend/routes.php?route=pessoas&id=${id}`, { method: 'DELETE' });
            carregarPessoas();
        }
    }

    // chamando carregarPessoas pra atualizar a listagem
    carregarPessoas();
</script>