<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', static function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')
                ->default(true)
                ->unsigned()
                ->index();
            $table->boolean('star')
                ->default(false)
                ->unsigned()
                ->index();
            $table->string('title', 255);
            $table->string('subtitle', 255)
                ->nullable();
            $table->string('author', 255)
                ->nullable();
            $table->text('summary')
                ->nullable();
            $table->longText('content')
                ->nullable();
            $table->string('video', 150)
                ->nullable();
            $table->timestamp('published_at')
                ->nullable();
            $table->text('tags')
                ->nullable();
            $table->string('image', 255)
                ->nullable();
            $table->text('images')
                ->nullable();
            $table->string('slug', 255)
                ->unique()
                ->index();
            $table->integer('order')
                ->nullable()
                ->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
