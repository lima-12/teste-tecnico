# Sistema de Controle de Gastos Residenciais

## **Estrutura do Projeto**

gastos-residenciais
    backend/                    # Lógica do servidor e APIs
        data/                   # Armazenamento em JSON
            pessoas.json
            transacoes.json
        PessoaController.php    # Funções que gerenciam o armazenamento de pessoas.json
        TransacaoController.php # Funções que gerenciam o armazenamento de transacoes.json
        routes.php              # Definição das rotas do backend
    
    frontend/                   # Interface do usuário
        assets/                 # "Contexto" - Recursos do seu projeto.
            js/                 # Funções que interligam o frontend com o backend
                pessoas.php
                transacoes.php
            style/              # Estilos css
                index.css
        components/             # blocos de código reutilizáveis
            footer.php
            header.php
        pessoas.php             # Gerenciamento das pessoas 
        transacoes.php          # Gerenciamento das transacoes
        index.php               # Página principal do sistema
    
    index.php               # Redireciona para frontend/index.php
    README.md               # Documentação do projeto

---

## **Como Rodar o Projeto**

### **Pré-requisitos**
- PHP >= 8.0
- Servidor local (ex.: XAMPP, WAMP, MAMP) ou PHP embutido

---

### **Passos para Iniciar**

1. **Clone o repositório:**
```bash
git clone https://github.com/seu-usuario/gastos-residenciais
cd gastos-residenciais
```

2. **Inicie o servidor PHP:**
```bash
php -S localhost:8000
```

3. **Acesse o sistema no navegador:**
```
http://localhost:8000
```

---

## **Estrutura de Dados**
- **Pessoas:** Armazenadas no arquivo `backend/data/pessoas.json`
- **Transações:** Armazenadas no arquivo `backend/data/transacoes.json`

---

## **Funcionalidades/Requisitos**
- **Cadastro de Pessoas:** Id, Nome e idade.
    ✅ 1. Criação.
    ✅ 2. Deleção.
    ✅ 3. Listagem. 
    ✅ 4. Em casos que se delete uma pessoa, todas as transações dessa pessoa deverão ser apagadas.
    arquivos 
        frontend/pessoas.php
        frontend/assets/js/pessoas.php
        backend/PessoasController.php
        backend/data/pessoas.json
        backend/router.php

- **Cadastro de Transações:** Id, Descrição, valor, tipo (receita/despesa) e pessoaId.
    ✅ 5. Criação.
    ✅ 6. Listagem. 
    ✅ 7. Caso o usuário informe um menor de idade (menor de 18), apenas despesas deverão ser aceitas.
        arquivos 
        frontend/transacoes.php
        frontend/assets/js/transacoes.php
        backend/TransacaoController.php
        backend/data/transacoes.json
        backend/router.php

- **Consulta de Totais:** Exibe receitas, despesas e saldo de cada pessoa, além do total geral.
    ✅ 8. Deverá listar todas as pessoas cadastradas, exibindo o total de receitas, despesas e o saldo (receita – despesa) de cada uma.
    ✅ 9. Ao final da listagem anterior, deverá exibir o total geral de todas as pessoas, incluindo o total de receitas, total de despesas e o saldo líquido. 
        arquivo frontend/index.php

---

## **Observações**
- O sistema utiliza armazenamento em arquivos JSON, dispensando banco de dados.

---

## **Tecnologias Utilizadas**
- **Backend:** PHP
- **Frontend:** HTML e CSS, JavaScript e Bootstrap 5

