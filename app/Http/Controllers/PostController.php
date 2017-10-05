<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

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
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * @param PostFormRequest $request
     * @return mixed
     */
    public function store(PostFormRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->fullDescription = $request->fullDescription;
        $post->description = $request->description;
        $post->image = '';
        $post->user()->associate(Auth::user());

        $post->save();

        return \Redirect::route('home')
            ->with('message', 'Post was successfully saved!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update($id, PostFormRequest $request)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->fullDescription = $request->fullDescription;
        $post->description = $request->description;
        $post->image = '';

        $post->save();

        return \Redirect::route('home')
            ->with('message', 'Post was successfully updated!');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.delete', ['post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return \Redirect::route('home')
            ->with('message', 'Post was successfully updated!');
    }
}
