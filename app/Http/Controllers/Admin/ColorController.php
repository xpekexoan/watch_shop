<?php

namespace App\Http\Controllers\Admin;

use App\Model\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public function all()
    {
        $data = Color::all();
        return response()->json($data);
    }
}
