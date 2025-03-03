# API de Filmes - Documentação

Esta API permite o gerenciamento de filmes e categorias com autenticação de usuários. Abaixo está a documentação das rotas disponíveis.

## Requisitos

- Docker
- Docker Compose

## Instalação

1. Clone o repositório:
   ```bash
   git clone [url-do-repositório]
   cd [nome-do-repositório]
   ```

2. Inicie os contêineres Docker:
   ```bash
   docker-compose up -d
   ```

3. Execute as migrações do banco de dados:
   ```bash
   docker-compose exec app php artisan migrate
   ```

4. Gere a chave JWT para autenticação:
   ```bash
   docker-compose exec app php artisan jwt:secret
   ```

## Rotas da API

### Autenticação (Prefixo `auth`)

Estas rotas não requerem autenticação:

| Método | Rota | Descrição |
|--------|------|-----------|
| POST | `/api/auth/register` | Registro de usuário |
| POST | `/api/auth/login` | Login do usuário (retorna token JWT) |
| POST | `/api/auth/logout` | Logout do usuário |

#### Exemplos de requisição

**Registro de usuário:**
```json
POST /api/auth/register
{
  "name": "Nome do Usuário",
  "email": "usuario@exemplo.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}
```

**Login:**
```json
POST /api/auth/login
{
  "email": "usuario@exemplo.com",
  "password": "senha123"
}
```

**Resposta de login bem-sucedido:**
```json
{
  "access_token": "eyJ0eXAiO...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

### Filmes (Prefixo `filmes`)

Todas as rotas abaixo requerem autenticação (`auth:api`). É necessário incluir o token JWT no cabeçalho das requisições:
```
Authorization: Bearer [seu-token-jwt]
```

| Método | Rota | Descrição |
|--------|------|-----------|
| POST | `/api/filmes` | Criação de um filme |
| GET | `/api/filmes` | Listagem de todos os filmes |
| GET | `/api/filmes/{id}` | Detalhes de um filme específico |
| PUT | `/api/filmes/{id}` | Edição de um filme |
| DELETE | `/api/filmes/{id}` | Exclusão de um filme |

#### Exemplos de requisição

**Criação de filme:**
```json
POST /api/filmes
{
  "titulo": "Título do Filme",
  "descricao": "Descrição do filme",
  "ano_lancamento": 2023,
  "diretor": "Nome do Diretor",
  "categoria_id": 1
}
```

### Categorias (Prefixo `categorias`)

Todas as rotas abaixo requerem autenticação (`auth:api`):

| Método | Rota | Descrição |
|--------|------|-----------|
| POST | `/api/categorias` | Criação de uma categoria |
| GET | `/api/categorias` | Listagem de todas as categorias |
| GET | `/api/categorias/{id}` | Detalhes de uma categoria específica |
| PUT | `/api/categorias/{id}` | Edição de uma categoria |
| DELETE | `/api/categorias/{id}` | Exclusão de uma categoria |

#### Exemplos de requisição

**Criação de categoria:**
```json
POST /api/categorias
{
  "nome": "Ação",
  "descricao": "Filmes de ação e aventura"
}
```

## Códigos de Status

- `200 OK`: Requisição bem-sucedida
- `201 Created`: Recurso criado com sucesso
- `400 Bad Request`: Erro na requisição
- `401 Unauthorized`: Não autenticado
- `403 Forbidden`: Sem permissão para acessar o recurso
- `404 Not Found`: Recurso não encontrado
- `422 Unprocessable Entity`: Erro de validação

## Estrutura do Banco de Dados

### Tabela Users
- id (primary key)
- name
- email (unique)
- password
- timestamps

### Tabela Categorias
- id (primary key)
- nome
- descricao
- timestamps

### Tabela Filmes
- id (primary key)
- titulo
- descricao
- ano_lancamento
- diretor
- categoria_id (foreign key referenciando categorias.id)
- timestamps