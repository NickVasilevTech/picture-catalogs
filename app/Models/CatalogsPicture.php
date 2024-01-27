<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogsPicture extends Model
{
    use HasFactory;

    public function catalog(): BelongsTo
    {
        return $this->belongsTo( Catalog::class );
    }

    public function picture(): BelongsTo
    {
        return $this->belongsTo( Picture::class );
    }
}
