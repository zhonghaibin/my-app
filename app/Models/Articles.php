<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    public function feeds(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Feeds::class,'article_id','id');
    }
}
