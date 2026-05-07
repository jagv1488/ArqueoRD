<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'file_path', 'file_type', 'is_public'];

    public function mediable()
    {
        return $this->morphTo();
    }
}
