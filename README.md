# Liveable

> Plataforma para aluguel de imóveis, permitindo que usuários encontrem, anunciem e gerenciem propriedades de forma simples e intuitiva.
---

## Sobre o projeto

A **Liveable** é uma plataforma web desenvolvida para conectar proprietários e hóspedes de diversos tipos de imóveis.

O sistema permite:

- Buscar imóveis
- Favoritar propriedades
- Reservar hospedagens
- Avaliar imóveis
- Cadastro e autenticação de usuários
- Cadastro de propriedades
- Visualização de informações detalhadas

---

## Demonstração

### Tela inicial

<img src="docs/home.png">

### Página de detalhes

<img src="docs/property-details.png">

### Perfil

<img src="docs/profile.png">

---

# Funcionalidades

- Login
- Cadastro
- Autenticação
- CRUD de imóveis
- Upload de imagens
- Sistema de avaliações
- Favoritos
- Pesquisa
- Responsividade
- API REST

---

# Tecnologias

## Front-end

- Vue 3
- TypeScript
- Vite
- Vue Router
- Axios
- Pinia
- Swiper
- Phosphor Icons

## Back-end

- Laravel
- PHP
- MySQL
- Sanctum

---

# Estrutura

```
liveable-app
│
├── frontend
│   ├── src
│   ├── assets
│   ├── components
│   ├── pages
│   └── router
│
├── backend
│   ├── app
│   ├── routes
│   ├── database
│   └── storage
│
└── README.md
```

---

# Como executar

## Clone

```bash
git clone https://github.com/CaioYL10/liveable-app.git
```

Entre na pasta

```bash
cd liveable-app
```

---

## Backend

```bash
cd backend

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve
```

---

## Frontend

```bash
cd frontend

npm install

npm run dev
```

---

# 🔗 API

Exemplo de rotas

```
GET /api/properties

GET /api/properties/{id}

POST /api/login

POST /api/register

POST /api/review

POST /api/favorite
```

# Arquitetura

```
Vue
   │
Axios
   │
Laravel API
   │
MySQL
```
