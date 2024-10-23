<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Technology extends Model
{
    use HasFactory;

    protected $table = 'technologies';

    protected $fillable = [
        'technology_types_id',
        'active',
        'name',
        'icon',
        'description',
    ];

    public function technology_type(): BelongsTo
    {
        return $this->belongsTo(TechnologyType::class, 'technology_types_id');
    }
}
