# Filament Articles

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)

O pacote **Filament Articles** é um plugin para o [Filament](https://filamentphp.com/) que fornece uma gestão completa de artigos para o painel administrativo [Admix](https://github.com/agenciafmd/filament-admix).

## Funcionalidades

- 📝 **Gestão Completa de Artigos**: CRUD completo com suporte a slug automático.
- 🖼️ **Suporte a Mídia**: Upload de imagem principal e galeria de imagens (opcional).
- 🏷️ **Tags**: Sistema de tags integrado com sugestões.
- 📅 **Agendamento**: Opção de data de publicação (`published_at`).
- ⭐ **Destaque**: Possibilidade de marcar artigos como destaque (`star`).
- 🔍 **AuditLog**: Integração com auditoria para rastrear alterações.
- 🦾 **Extensível**: Configurações flexíveis para habilitar/desabilitar campos como subtítulo e vídeo.

## Instalação

Como este é um pacote local, você deve garantir que o seu `composer.json` principal aponta para o diretório de pacotes:

```json
"repositories": {
    "agenciafmd/filament-articles": {
        "type": "path",
        "url": "packages/agenciafmd/filament-articles",
        "options": {
            "symlink": true
        }
    }
}
```

Em seguida, instale o pacote via composer:

```bash
composer require agenciafmd/filament-articles
```

Execute as migrações:

```bash
php artisan migrate
```

## Configuração

Você pode publicar o arquivo de configuração para personalizar o comportamento do plugin:

```bash
php artisan vendor:publish --tag="filament-articles-config"
```

O arquivo de configuração permite habilitar campos adicionais e definir dimensões de imagem:

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
    // ...
];
```

## Registro do Plugin

Adicione o plugin ao seu painel do Filament no arquivo `app/Providers/Filament/AdminPanelProvider.php` (ou similar):

```php
use Agenciafmd\Articles\ArticlesPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            ArticlesPlugin::make(),
        ]);
}
```

## Tradução

As traduções estão disponíveis em Português do Brasil (pt_BR). Se desejar traduzir para outros idiomas, publique as traduções:

```bash
php artisan vendor:publish --tag="filament-articles-lang"
```

---

Desenvolvido por [Agência FMD](https://fmd.ag/)
