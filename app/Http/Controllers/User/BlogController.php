<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = 5;
    }

    public function index()
    {
        $blogs = Blog::orderby('created_at', 'desc')->paginate($this->limit);
        return view('user.blog.index',compact('blogs'));
    }

    public function detail($id)
    {
        $blog = Blog::findOrFail($id);
        return view('user.blog.detail',compact('blog'));
    }
}
