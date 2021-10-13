<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name', 'id_province'
    ];

    protected $table = 'district';

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province', 'id');
    }
}
