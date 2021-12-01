<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
    protected $fillable = ['name', 'user_id', 'post_time', 'description'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
