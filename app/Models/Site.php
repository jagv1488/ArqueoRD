<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'province', 'period', 'public_description',
        'latitude', 'longitude', 'elevation', 'threat_level', 'technical_notes', 'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function discoveries() { return $this->hasMany(Discovery::class); }
    public function media() { return $this->morphMany(MediaAttachment::class, 'mediable'); }
}
