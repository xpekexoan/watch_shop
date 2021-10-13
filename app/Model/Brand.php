<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    protected $table = 'brand';

    protected $attributes = [
        'status' => true
    ];

    public function displayStatus()
    {
        return $this->status ? 'Hiển thị' : 'Ẩn';
    }
}
