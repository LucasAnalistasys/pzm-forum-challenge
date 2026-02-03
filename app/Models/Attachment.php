<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
class Attachment extends Model
{
    use HasUuid;

    protected $fillable = ['file_path', 'file_name', 'file_type', 'attachable_id', 'attachable_type'];

    public function attachable()
    {
        return $this->morphTo();
    }

}
