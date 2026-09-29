# Filament – Articles

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/filament-articles.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/filament-articles)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Pacote de Artigos para o painel administrativo (Admix). Entrega o CRUD completo de artigos (título, resumo, conteúdo, imagem, galeria, vídeo, marcadores, destaque e data de publicação), com filtros, lixeira e auditoria.

## Requisitos

- PHP ^8.4
- Laravel ^12.0 | ^13.0
- Filament ^5.0
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

3. Populando o banco com dados de testes

Adicione o seeder no `database/seeders/DatabaseSeeder.php`:

```php
use Agenciafmd\Articles\Database\Seeders\ArticleSeeder;

$this->call([
    ArticleSeeder::class,
]);
```

Ou rode o seeder manualmente:

```bash
php artisan db:seed --class="Agenciafmd\Articles\Database\Seeders\ArticleSeeder"
```

## Ativando no painel

O pacote inclui o plugin `ArticlesPlugin`, que registra o `ArticleResource`. Adicione-o na config do Admix `config/filament-admix.php`:

```php
use Agenciafmd\Articles\ArticlesPlugin;

return [
    'plugins' => [
        ArticlesPlugin::class,
    ],
];
```

Após isso, o menu **Artigos** aparecerá no painel, com as páginas de Listar, Criar e Editar.

## Configuração

Arquivo: `config/filament-articles.php`

```php
return [
    'name' => 'Articles',
    'navigation_group' => null,
    'navigation_sort' => 6,
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
    ],
    'images' => [
        'visible' => false,
        'width' => 1920,
        'height' => 1080,
    ],
];
```

| Chave | Padrão | Descrição |
|---|---|---|
| `name` | `Articles` | Nome do pacote. |
| `navigation_group` | `null` | Grupo do menu em que o Resource aparece. |
| `navigation_sort` | `6` | Posição do item no menu. |
| `subtitle.visible` | `false` | Exibe o campo de subtítulo no formulário. |
| `video.visible` | `false` | Exibe o campo de vídeo no formulário. |
| `image.visible` | `true` | Exibe o campo de imagem principal. |
| `image.width` / `image.height` | `1920` / `1080` | Dimensões do crop da imagem principal. |
| `images.visible` | `false` | Exibe o campo de galeria de imagens. |
| `images.width` / `images.height` | `1920` / `1080` | Dimensões do crop das imagens da galeria. |

O pacote não publica o arquivo de config. Para sobrescrever, crie `config/filament-articles.php` no projeto: ele é mesclado com o do pacote apenas no primeiro nível, então chaves com array (como `image`) devem ser informadas por completo.

Artigos excluídos há mais de 30 dias são removidos definitivamente pelo `model:prune`, agendado diariamente às 03h (os minutos vêm de `filament-admix.schedule.minutes`).

## Permissões

O `ArticleResource` entra automaticamente no controle de acesso por Grupos do Admix, com as permissões de visualizar, criar, editar, excluir, restaurar e auditoria. Usuário sem grupo é administrador e tem acesso total. Não há permissões extras.

## Auditoria

O `ArticleResource` inclui o relation manager `Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager`, exibindo o histórico de auditorias do registro (o `tapp/filament-auditing` é instalado pelo `filament-admix`).

## Licença

Este pacote é software livre e está disponível nos termos da licença MIT.
