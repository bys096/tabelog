<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiarySegment extends Model
{
    use HasFactory;

    protected $fillable = [
        'dairy_id',
        'content',
        'meal_time',
    ];

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }

    public function hashTags()
    {
        return $this->belongsToMany(HashTag::class);
    }

}
