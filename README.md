# Forum PZM

Projeto de exemplo / base para um fórum de perguntas e respostas.

## **Como Instalar**

- **Pré-requisitos:** `PHP` (8.0+ recomendado), `Composer`, `Node.js` + `npm` ou `yarn`, banco de dados (MySQL/Postgres), `git`.
- Clone o repositório:

  ```bash
  git clone https://seu-repositorio.git
  cd forum-pzm
  ```

- Instale dependências PHP e JS:

  ```bash
  composer install
  npm install
  # ou yarn
  ```

- Copie o arquivo de ambiente e ajuste as credenciais do banco:

  ```bash
  cp .env.example .env
  # editar .env para configurar DB, APP_URL, etc.
  php artisan key:generate
  ```

- Build assets (desenvolvimento ou produção):

  ```bash
  npm run dev    # desenvolvimento
  npm run build  # produção
  ```

## **Como rodar migrations**

- Garanta que as variáveis de conexão no `.env` estão corretas.
- Rodar migrations:

  ```bash
  php artisan migrate
  ```

- Para limpar e recriar todas as tabelas (ambiente de dev):

  ```bash
  php artisan migrate:fresh --seed
  ```

## **Como rodar testes**

- Executar suíte de testes com PHPUnit:

  ```bash
  ./vendor/bin/phpunit
  # ou
  php artisan test
  ```

- No Windows pode ser necessário usar o executável `.bat`:

  ```powershell
  vendor\\bin\\phpunit.bat
  ```

## **Arquitetura**

O projeto segue um padrão inspirado no Laravel com separação clara entre camadas:

- `app/Http/Controllers` — controladores HTTP (entrada/saída).
- `app/Models` — modelos das entidades (`Question`, `Answer`, `User`).
- `app/Repositories` — abstração de acesso a dados.
- `app/Services` — regras de negócio e orquestração.
- `app/Http/Requests` — validações específicas de requisição.
- `app/Providers` — registros e bindings de serviços.
- `database/migrations`, `database/factories`, `database/seeders` — esquema e dados de teste.

## **Divisões de Responsabilidades**

- **Controladores:** Recebem requisições, validam via `Requests` e delegam para `Services`.
- **Requests:** Contêm regras de validação e autorização por endpoint.
- **Services:** Implementam lógica de aplicação e orquestram `Repositories`.
- **Repositories:** Lidam com persistência (queries, transações, queries complexas).
- **Models:** Representam entidades e relacionamentos (Eloquent).
- **Providers:** Registram dependências e configurações globais.
- **Traits:** Comportamentos reutilizáveis (ex.: `HasUuid`).

## **Pontos de Melhoria**

- Cobertura de testes mais ampla (unitários e de integração).
- Integração contínua (CI) com GitHub Actions para rodar testes e linter.
- Documentação da API (OpenAPI/Swagger).
- Melhor tratamento de erros e respostas padronizadas (API Resource / DTOs).
- Caching para endpoints pesados e paginação consistente.
- Implementar contratos/interfaces para `Repositories` e `Services` para facilitar testes e troca de implementação.
- Monitoramento, logs estruturados e alertas.

## **Decisões Técnicas Importantes**

- Padrão Repository + Service para manter controllers finos e lógica testável.
- Uso de migrations, factories e seeders para garantir reprodutibilidade de ambiente e testes.
- UUIDs via `HasUuid` para identificação de recursos quando necessário.
- Testes com `PHPUnit` e comandos via `php artisan test` para consistência com Laravel.
- Organização modular de código (`app/Repositories`, `app/Services`) para facilitar manutenção e evolução.

---

Se quiser, posso adicionar um arquivo `README` em inglês, um guia de contribuição ou um workflow de CI (GitHub Actions) para rodar testes automaticamente.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
