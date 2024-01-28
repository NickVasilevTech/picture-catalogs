<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'name'  => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function catalogPictures(): HasMany
    {
        return $this->hasMany( CatalogsPicture::class );
    }

    public static function getCatalogsByUserId(int $userId, bool $withPictureIds = false, bool $asArray = false, int $limit = 0)
    {
        $query = DB::table('catalogs')
        ->select('catalogs.id', 'catalogs.name', 'users.username as authorName')
        ->where('user_id', '=', $userId)
        ->join('users', 'catalogs.user_id', '=', 'users.id')
        ->orderBy('catalogs.created_at', 'desc');

        if ($limit > 0) {
            $query->limit($limit);
        }

        if ($withPictureIds) {
            $query->leftJoin('catalogs_pictures', 'catalogs.id', '=', 'catalogs_pictures.catalog_id')
            ->selectRaw('GROUP_CONCAT(`catalogs_pictures`.`picture_id` ORDER BY `catalogs_pictures`.`created_at` DESC SEPARATOR ",") as pictures')
            ->groupBy('catalogs.id');
        }

        return ($asArray)? $query->get()->toArray() : $query->get();
    }

    public static function getPicturesInCatalog(int $catalogId, bool $withFilenamesAndAuthors = false)
    {
        $query = DB::table('catalogs_pictures')
        ->select('catalogs_pictures.picture_id')
        ->where('catalog_id', '=', $catalogId)
        ->orderBy('catalogs_pictures.created_at', 'desc');

        if ($withFilenamesAndAuthors) {
            $query->join('pictures', 'catalogs_pictures.picture_id', '=', 'pictures.id')
            ->join('users', 'pictures.user_id', '=', 'users.id')
            ->addSelect('pictures.id','pictures.filename', 'users.username as authorName');
        }

        return $query->get();
    }

    public static function getThumbnailFilename(int $catalogId)
    {
        $query = DB::table('catalogs_pictures')
        ->select('pictures.filename')
        ->join('pictures', 'catalogs_pictures.picture_id', '=', 'pictures.id')
        ->where('catalog_id', '=', $catalogId)
        ->orderBy('catalogs_pictures.created_at');

        return $query->first();
    }
}
