<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function fields(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Field::class, 'fieldable');
    }

    public function propertyType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
}
