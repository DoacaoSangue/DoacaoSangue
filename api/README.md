# 🩸 API RESTful - Sistema de Doação de Sangue

Este projeto consiste no desenvolvimento de uma **API RESTful** utilizando **Laravel** com autenticação via **Laravel Sanctum**, seguindo os princípios da arquitetura **MVC**. Todas as respostas são retornadas no formato **JSON**.

A API permite o gerenciamento de **usuários**, **locais de doação**, **doações realizadas** e **tipos sanguíneos**, com controle de acesso diferenciado entre **usuário comum** e **administrador**.

## 📚 Tecnologias Utilizadas

- PHP 8.2
- Laravel 12.x
- MySQL
- Laravel Sanctum (Autenticação por token)
- Composer

## ⚙️ Instalação e Configuração

### 1. Clonar o projeto:

```bash
git clone https://github.com/DoacaoSangue/DoacaoSangue
cd api
```

### 2. Instalar as dependências PHP:

```bash
composer install
```

### 3. Configurar o arquivo `.env`:

```bash
cp .env.example .env
```

Configure as variáveis de conexão com o banco de dados MySQL:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doacao_sangue
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Executar as migrations:

```bash
php artisan migrate
```

### 5. Popular dados iniciais:

```bash
php artisan db:seed
```

### 6. Instalar o Sanctum:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### 7. Iniciar o servidor local:

```bash
php artisan serve
```

## 🔐 Autenticação e Controle de Acesso

A API utiliza **Laravel Sanctum** para autenticação via **Token Bearer**.

Após o login, o usuário recebe um token que deve ser enviado no header das requisições:

```
Authorization: Bearer SEU_TOKEN_AQUI
```

## 📑 Permissões de Acesso por Perfil

### Endpoints Públicos (Sem autenticação):

| Método | Endpoint | Função |
|---|---|---|
| POST | `/api/register` | Cadastro de novo usuário |
| POST | `/api/login` | Login |

### Endpoints para Usuário Autenticado (Tipo Comum):

*(Somente após login, com token válido)*

| Método | Endpoint | Função |
|---|---|---|
| POST | `/api/logout` | Logout |
| GET | `/api/tipos-sanguineos` | Listar todos os tipos sanguíneos |
| GET | `/api/locais` | Listar todos os locais de doação |
| GET | `/api/locais/{id}` | Ver detalhes de um local |
| GET | `/api/doacoes` | Listar apenas as doações em que o usuário é **doador ou recebedor** |
| GET | `/api/doacoes/{id}` | Ver detalhes de uma doação **se o usuário for doador ou recebedor** |
| GET | `/api/usuarios/{id}` | Ver os próprios dados **(o usuário só pode consultar o próprio ID)** |

### Endpoints Exclusivos para Administrador:

*(Requer usuário com `tipo_usuario = 1`)*

| Método | Endpoint | Função |
|---|---|---|
| GET | `/api/usuarios` | Listar todos os usuários |
| POST | `/api/usuarios` | Criar usuário |
| PUT | `/api/usuarios/{id}` | Atualizar qualquer usuário |
| DELETE | `/api/usuarios/{id}` | Excluir qualquer usuário |
| POST | `/api/locais` | Criar local |
| PUT | `/api/locais/{id}` | Atualizar local |
| DELETE | `/api/locais/{id}` | Excluir local |
| POST | `/api/doacoes` | Criar nova doação |
| PUT | `/api/doacoes/{id}` | Atualizar doação |
| DELETE | `/api/doacoes/{id}` | Excluir doação |
| GET | `/api/doacoes` | Listar todas as doações **(sem filtro por usuário)** |

## ✅ Validações Importantes:

- **Senhas:** Mínimo de 8 caracteres, com pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.
- **Email:** Obrigatório e único no sistema.
- **Campos obrigatórios no cadastro:** Email, nome, senha, telefone, endereço, tipo de usuário, id_tipo_sanguineo, alergias, doar e receber.

## ✅ Exemplo de Fluxo de Teste (Usando Postman):

1. **Registrar um usuário:**  
POST `/api/register`

2. **Login:**  
POST `/api/login`

3. **Copiar o token de resposta**

4. **Nas próximas requisições:**  
Adicionar no Header:  

```
Authorization: Bearer SEU_TOKEN_AQUI
```

5. **Testar os endpoints permitidos de acordo com o perfil**

## ✅ Conclusão:

O projeto foi desenvolvido seguindo boas práticas de segurança, organização de código e autenticação. Cada endpoint possui controle de acesso conforme o perfil do usuário, atendendo aos requisitos do projeto acadêmico.