# PZM Forum Challenge

Este é um projeto de API para um fórum de perguntas e respostas, desenvolvido com Laravel.

## Como Rodar o Projeto

### Pré-requisitos
- PHP ^8.2
- Composer
- Banco de dados (MySQL, PostgreSQL, etc.)

### Passos para Execução

1. Clone o repositório e navegue até a pasta do projeto.

2. Instale as dependências do PHP:
   ```
   composer install
   ```

3. Copie o arquivo de configuração do ambiente:
   ```
   cp .env.example .env
   ```

4. Gere a chave da aplicação:
   ```
   php artisan key:generate
   ```

5. Configure o banco de dados no arquivo `.env` e execute as migrações:
   ```
   php artisan migrate
   ```

6. Inicie o servidor:
   ```
   php artisan serve
   ```

## Como Rodar os Testes

Para executar os testes, use o comando:
```
composer run test
```

Ou diretamente:
```
php artisan test
```

Isso limpará o cache de configuração e executará os testes usando PHPUnit.

## Decisões Técnicas Tomadas

- **Framework**: Laravel 12 para desenvolvimento rápido e robusto de APIs.
- **Autenticação**: Laravel Sanctum para API tokens, permitindo autenticação stateless.
- **Banco de Dados**: Uso de UUIDs como chaves primárias para melhor escalabilidade e segurança (evita enumeração sequencial).
- **Padrão Arquitetural**: Separação em Repositories (acesso a dados) e Services (lógica de negócio), promovendo testabilidade e manutenção.
- **Slug para Perguntas**: Geração automática de slugs únicos para URLs amigáveis.
- **Anexos**: Relacionamento polimórfico para permitir anexos em perguntas e respostas.
- **Testes**: PHPUnit com testes de feature para endpoints da API.

## O que Você Optou por Não Implementar e Por Quê

- **Interface de Usuário Completa**: Foco no backend API. Uma UI completa seria necessária para um produto final, mas como desafio, priorizei a API robusta.
- **Verificação de Email**: Não implementada para simplificar o desenvolvimento. Em produção, seria essencial para segurança.
- **Paginação Avançada**: Uso básico do Laravel. Poderia ser expandido com meta links, etc.
- **Cache**: Não implementado para reduzir complexidade. Em produção, caching seria importante para performance.
- **Notificações**: Não há sistema de notificações para novas respostas, etc., para manter o escopo limitado.
- **Moderação de Conteúdo**: Sem sistema de moderação ou flags, assumindo usuários confiáveis.

## Pontos que Você Melhoraria com Mais Tempo

- **Docker**: Implementar Docker para containerização, facilitando desenvolvimento e deploy. Usar Laravel Sail já incluído, mas configurar completamente com docker-compose para banco, etc.
- **Testes Mais Abrangentes**: Adicionar testes unitários para services e repositories, além de testes de integração.
- **Documentação da API**: Usar Swagger/OpenAPI para documentar endpoints.
- **Rate Limiting**: Implementar throttling para proteger contra abuso.
- **Logs e Monitoramento**: Integrar ferramentas como Sentry para monitoramento em produção.
- **Otimização de Performance**: Adicionar índices no banco, eager loading otimizado, cache com Redis.
- **Segurança**: Implementar validações mais rigorosas, sanitização de inputs, proteção contra XSS em frontend futuro.
- **Deploy**: Configurar CI/CD com GitHub Actions ou similar para deploy automático.</content>
<parameter name="filePath">c:\Users\lucas\Desktop\pzm\pzm-forum-challenge\README.md
