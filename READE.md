# 💸 Sistema de Controle de Gastos Residenciais

## 📂 **Estrutura do Projeto**
```bash
gastos-residenciais-maxiprod/
├── backend/                # Lógica do servidor e APIs
│   ├── data/               # Armazenamento em JSON (pessoas.json, transacoes.json)
│   ├── PessoaController.php
│   ├── TransacaoController.php
│   └── routes.php          # Definição das rotas do backend
├── frontend/               # Interface do usuário
│   ├── cadastro_pessoas.php
│   ├── cadastro_transacoes.php
│   └── index.php           # Página principal do sistema
├── vendor/                 # Dependências do Composer
├── index.php               # Redireciona para frontend/index.php
├── composer.json           # Configuração do autoload e dependências PHP
└── README.md               # Documentação do projeto
```

---

## 🚀 **Como Rodar o Projeto**

### **Pré-requisitos**
- PHP >= 8.0
- Servidor local (ex.: XAMPP, WAMP, MAMP) ou PHP embutido
- Composer instalado (https://getcomposer.org/)

---

### **Passos para Iniciar**

1. **Clone o repositório:**
```bash
git clone https://github.com/seu-usuario/gastos-residenciais-maxiprod.git
cd gastos-residenciais-maxiprod
```

2. **Instale as dependências:**
```bash
composer install
```

3. **Inicie o servidor PHP:**
```bash
php -S localhost:8000
```

4. **Acesse o sistema no navegador:**
```
http://localhost:8000
```

---

## 📦 **Estrutura de Dados**
- **Pessoas:** Armazenadas no arquivo `backend/data/pessoas.json`
- **Transações:** Armazenadas no arquivo `backend/data/transacoes.json`

---

## 💡 **Funcionalidades**
- **Cadastro de Pessoas:** Nome e idade.
- **Cadastro de Transações:** Descrição, valor, tipo (receita/despesa) e pessoa associada.
- **Consulta de Totais:** Exibe receitas, despesas e saldo de cada pessoa, além do total geral.

---

## ⚠️ **Observações**
- O sistema utiliza armazenamento em arquivos JSON, dispensando banco de dados.
- Em caso de problemas com permissões de arquivos, certifique-se de que a pasta `data` permita leitura e escrita.

---

## 🛠 **Tecnologias Utilizadas**
- **Backend:** PHP (sem frameworks)
- **Frontend:** HTML, Bootstrap 5
- **Autoloading:** Composer PSR-4

