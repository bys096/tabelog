<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Models\User;

class Diary extends Model
{
    use HasFactory;

    public $timestamps = false;                     // UpdatedAt,CreatedAtを使わないなら、必ずFalseを付与します。

    protected $fillable = [
        'date', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(HashTag::class);
    }

    public function diaryFiles()
    {
        return $this->hasMany(DiaryFile::class);
    }

    public function diarySegments()
    {
        return $this->hasMany(DiarySegment::class);
    }
}
