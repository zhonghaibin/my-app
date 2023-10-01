<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'subtitle', 'title', 'description', 'cover', 'status'];

    public function feeds(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Feeds::class, 'article_id', 'id');
    }
}
