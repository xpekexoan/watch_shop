<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    protected $table = 'category';

    protected $attributes = [
        'status' => true
    ];

    public function displayStatus() {
        return $this->status ? 'Hiển thị' : 'Ẩn';
    }
}
