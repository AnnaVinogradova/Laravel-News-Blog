<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    const POST_PER_PAGE = 5;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(self::POST_PER_PAGE);
        return view('posts.index', array('posts' => $posts));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', array('post' => $post));
    }
}
