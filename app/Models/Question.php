<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Importante para o UUID
use App\Traits\HasUuid;

class Question extends Model
{
    use HasFactory,HasUuid;

    protected $fillable = ['title', 'slug', 'body', 'user_id'];

    // Define que o ID não é um número que cresce sozinho
    public $incrementing = false;
    protected $keyType = 'string';
}
