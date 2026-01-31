<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
    use HasUuid;

    protected $fillable = ['body', 'user_id', 'question_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }




}
