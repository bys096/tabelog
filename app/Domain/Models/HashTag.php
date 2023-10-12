<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name'
    ];

    public function diarySegments()
    {
        return $this->belongsToMany(DiarySegment::class);
    }
}
