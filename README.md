# Agenciafmd – Filament Articles

Pacote de Artigos para o painel administrativo (Admix) baseado em Filament v4 e Laravel 12. Ele fornece o CRUD completo de artigos (model, migração, resource Filament, tabela, formulários, fábrica e seeder), incluindo auditoria, filtros e configurações opcionais para mídia e campos adicionais.

## Requisitos

- PHP ^8.4
- Laravel ^12.0
- Filament ^4.0
- agenciafmd/filament-admix v1.x-dev | dev-master

## Instalação

1. Instale o pacote via Composer:

```bash
composer require agenciafmd/filament-articles
```

Caso esteja desenvolvendo localmente dentro de um monorepo, adicione o repositório `path` no `composer.json` do app e rode `composer require agenciafmd/filament-articles:*`.

2. Execute as migrações:

```bash
php artisan migrate
```

3. (Opcional) Popule o banco com dados falsos:

```bash
php artisan db:seed --class=Agenciafmd\\Articles\\Database\\Seeders\\ArticleSeeder
```

## Ativando no painel Filament

Este pacote inclui um Plugin Filament que registra o `ArticleResource` automaticamente. Adicione o plugin na config do admix `config/filament-admix.php`:

```php
use Agenciafmd\Articles\ArticlesPlugin;

return [
    'plugins' => [
        ArticlesPlugin::class,
    ],
];
```

Após isso, o menu "Articles" aparecerá no painel, com as páginas de Listar, Criar e Editar.

## Recursos incluídos

- Model: `Agenciafmd\Articles\Models\Article` (com Soft Deletes, HasFactory, Auditing e limpeza programada via `prunable()`)
- Migração: cria a tabela `articles` com campos principais (`title`, `subtitle` opcional, `summary`, `content`, `video` opcional, `image` opcional, `images` opcional, `tags`, `slug` único, flags `is_active` e `star`, `published_at`, timestamps e soft deletes)
- Factory e Seeder: `ArticleFactory` e `ArticleSeeder`
- Resource Filament: `ArticleResource` com páginas `ListArticles`, `CreateArticle`, `EditArticle`
- Tabela: `ArticlesTable` com colunas, filtros (inclusive `Trashed`), ações em lote e ordenação padrão
- Serviço: `ArticleService` (tags únicas para sugestões)
- Traduções pt_BR prontas

## Configuração

Arquivo: `config/filament-articles.php`

```php
return [
    'name' => 'Articles',

    'subtitle' => [
        'visible' => false,
    ],

    'video' => [
        'visible' => false,
    ],

    'image' => [
        'visible' => true,
        'width' => 1920,
        'height' => 1080,
        'ratio' => ['16:9'],
    ],

    'images' => [
        'visible' => false,
        'width' => 1920,
        'height' => 1080,
        'ratio' => ['16:9'],
    ],
];
```

Observações:
- `subtitle.visible` e `video.visible` controlam a exibição dos campos no formulário.
- Para `image` e `images`, as chaves controlam exibição e parâmetros do editor de imagem (largura/altura/ratio).
- O formulário usa `imageEditorAspectRatioOptions`, `imageEditorViewportWidth` e `imageEditorViewportHeight` baseados nesses valores.

## Auditoria

O `ArticleResource` inclui o relation manager `Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager`, exibindo o histórico de auditorias quando o pacote `tapp/filament-auditing` for utilizado pelo projeto via `filament-admix`.

## Licença

Este pacote é software livre e está disponível nos termos da licença MIT.
