<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    // Carrega o trait automaticamente ao inicializar o modelo
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Indica que a chave primária não é auto-incrementável
    public function getIncrementing()
    {
        return false;
    }

    // Indica que o tipo da chave primária é string
    public function getKeyType()
    {
        return 'string';
    }
}