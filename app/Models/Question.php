<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 
use App\Traits\HasUuid;

class Question extends Model
{
    use HasFactory,HasUuid;

    protected $fillable = ['title', 'slug', 'content', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public $incrementing = false;
    protected $keyType = 'string';
}
