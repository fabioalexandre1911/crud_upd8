CRUD - Cadastro de Clientes

Bem-vindo ao CRUD_UPD8, um sistema de cadastro de clientes simples e eficiente, desenvolvido em PHP com MySQL e interface responsiva usando Bootstrap.

🚀 Funcionalidades

🔐 Autenticação de Usuário: Login seguro com controle de sessão.

📋 Gerenciamento de Clientes (CRUD):

Criar: Adicione novos clientes facilmente.

Ler: Visualize a lista completa de clientes.

Atualizar: Edite informações de clientes existentes.

Excluir: Remova clientes de forma segura.

🔎 Busca por CPF: Pesquisa rápida e eficiente pelo número do CPF.

🛠️ Tecnologias Utilizadas

Backend: PHP

Frontend: HTML, CSS (Bootstrap 4), JavaScript (jQuery)

Banco de Dados: MySQL

📂 Estrutura do Projeto

├── classes/
│   └── Cliente.php         # Lógica de manipulação de dados do cliente
├── config/
│   └── db.php              # Configuração da conexão com o banco de dados
├── index.php               # Página principal do CRUD
├── login.php               # Tela de login
├── logout.php              # Script de logout
├── cadastrar.php           # Cadastro e atualização de clientes
├── excluir.php             # Exclusão de clientes
└── README.md               # Documentação do projeto

⚙️ Configuração do Ambiente

Clone o repositório:

git clone https://github.com/seu-usuario/crud_upd8.git
cd crud_upd8

Configure o banco de dados:

Crie um banco de dados MySQL.

Atualize config/db.php com suas credenciais de conexão.

Importe o banco de dados:

Importe o script SQL (se houver) para criar as tabelas necessárias.

Inicie o servidor local:

Use Laragon, XAMPP ou outro servidor de sua preferência.

Acesse o sistema:

Abra http://localhost/crud_upd8/index.php no navegador.

🔑 Credenciais Padrão

Usuário: admin

Senha: senha

⚠️ Importante: Altere as credenciais padrão para ambientes de produção.

🚧 Melhorias Futuras

Autenticação avançada com criptografia de senhas.

Validação de dados do lado do cliente e servidor.

Paginação para grandes volumes de dados.

Integração com APIs para validação de CPF.

📄 Licença

Este projeto está sob a licença MIT. Sinta-se livre para usar, modificar e contribuir!

