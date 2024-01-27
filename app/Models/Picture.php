<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
    ];

    protected $casts = [
        'filename'  => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function comments(): HasMany
    {
        return $this->hasMany( Comment::class );
    }

    public static function getPicturesByUserId(int $userId, int $limit = 0)
    {
        $query = DB::table('pictures')
            ->select('pictures.id', 'pictures.filename', 'pictures.user_id', 'pictures.created_at', 'users.username as authorName')
            ->where('user_id', '=', $userId)
            ->join('users', 'pictures.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc');

        if ($limit > 0)
            $query->limit($limit);

        return $query->get();
    }

    public static function getLatestPictures(int $limit = 8)
    {
        $query = DB::table('pictures')
            ->select('pictures.id', 'pictures.filename', 'pictures.user_id', 'pictures.created_at', 'users.username as authorName')
            // ->where('user_id', '=', $userId)
            ->join('users', 'pictures.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc');

        if ($limit > 0)
            $query->limit($limit);

        return $query->get();
    }

    public static function getCommentsByPictureId(int $pictureId, int $limit = 0)
    {
        $query = DB::table('comments')
            ->select('comments.body', 'comments.created_at', 'users.username as authorName')
            ->where('picture_id', '=', $pictureId)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->orderBy('created_at');

        if ($limit > 0)
            $query->limit($limit);

        return $query->get();
    }
}
