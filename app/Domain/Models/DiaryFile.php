<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_name', 'file_name', 'type', 'size', 'diary_id'
    ];

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
}
