<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'content', 'image'
    ];

    protected $table = 'blog';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');;
    }
}
    