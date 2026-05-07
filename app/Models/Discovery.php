<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discovery extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id', 'user_id', 'registration_code', 'name', 'material_category',
        'conservation_status', 'is_extracted', 'stratigraphic_layer', 'depth_cm',
        'private_notes', 'public_description', 'is_public'
    ];

    protected $casts = [
        'is_extracted' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function site() { return $this->belongsTo(Site::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function media() { return $this->morphMany(MediaAttachment::class, 'mediable'); }
}
