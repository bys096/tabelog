<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DiarySegment extends Model
{
    use HasFactory;

    protected $fillable = [
        'dairy_id',
        'content',
        'meal_time',
    ];

    protected static function booted()
    {
        parent::boot();
        static::deleting(function ($segment) {
            Log::info('deleteing 이벤트 호출');
            $segment->hashTags()->detach();
        });
    }

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }

    public function hashTags()
    {
        return $this->belongsToMany(HashTag::class);
    }

}
