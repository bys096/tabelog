<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Models\User;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'user_id'
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
}
