<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Serializer::class, static function (): Serializer {
            return new Serializer(
                [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())],
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
