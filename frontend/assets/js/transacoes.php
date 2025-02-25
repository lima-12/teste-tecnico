<script>

    /**
     * Funcionalidade - Cadastro de Transações
     * "5. Criação."
     * 
     * Essa função é acionada ao enviar o formulário de cadastro de transacoes.
     * Coleta os dados do formulário e envia uma requisição POST para a rota de transacoes.
     * Exibe mensagens de sucesso ou erro conforme o retorno do backend.
     */
    document.getElementById('formTransacao').addEventListener('submit', async (e) => {
        e.preventDefault();
        const descricao = document.getElementById('descricao').value;
        const valor = document.getElementById('valor').value;
        const tipo = document.getElementById('tipo').value;
        const pessoaId = document.getElementById('pessoaId').value;

        const response = await fetch('../../backend/routes.php?route=transacoes', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ descricao, valor, tipo, pessoaId })
        });

        const resultado = await response.json();
        if (response.ok) {
            carregarTransacoes();
            document.getElementById('formTransacao').reset();
        } else {
            alert('Erro ao cadastrar transacao!');
        }
        if (resultado.erro) {
            alert(resultado.erro);
        } else {
            alert('Transação cadastrada com sucesso!');
            document.getElementById('formTransacao').reset();
        }
    });

    /**
     * Funcionalidade - Listagem de Transações
     * "6. Listagem."
     * 
     * A função 'carregarTransacoes' busca todas as transações no backend
     * e exibe os dados na interface de forma dinâmica.
     */
    async function carregarTransacoes() {
        const response = await fetch('../../backend/routes.php?route=transacoes');
        const transacoes = await response.json();
        const lista = document.getElementById('listaTransacoes');
        lista.innerHTML = '';

        transacoes.forEach(transacoes => {
            lista.innerHTML += `<li class="list-group-item">
                ${transacoes.descricao} (valor: ${transacoes.valor}) - ${transacoes.tipo} - ${transacoes.pessoaId}
                <button onclick="deletarTransacao(${transacoes.id})" class="btn btn-danger btn-sm float-end">Excluir</button>
            </li>`;
        });
    }

    /**
     * 
     * A função 'deletarTransacao' solicita a confirmação do usuário,
     * envia uma requisição DELETE para remover a transação do backend,
     * e recarrega a listagem ao concluir.
     */
    async function deletarTransacao(id) {
        if (confirm('Tem certeza que deseja deletar essa transação?')) {
            await fetch(`../../backend/routes.php?route=transacoes&id=${id}`, { method: 'DELETE' });
            carregarTransacoes();
        }
    }

    carregarTransacoes();
</script>