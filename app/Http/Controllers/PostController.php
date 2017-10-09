<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Http\Services\PostService;
use App\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    const POST_PER_PAGE = 5;

    protected $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(self::POST_PER_PAGE);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
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
     * @return \Redirect
     */
    public function store(PostFormRequest $request)
    {
        try {
            $post = new Post();
            $this->postService->fillPost($post, $request);
            $post->user()->associate(Auth::user());

            $post->save();
        } catch (\Exception $e) {
            return \Redirect::route('home')
                ->with('message', 'Error:' . $e->getMessage());
        }

        return \Redirect::route('home')
            ->with('message', 'Post was successfully saved!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * @param int $id
     * @param PostFormRequest $request
     * @return \Redirect
     */
    public function update(int $id, PostFormRequest $request)
    {
        $post = Post::findOrFail($id);
        try {
            $this->postService->fillPost($post, $request);

            $post->save();
        } catch (\Exception $e) {
            return \Redirect::route('home')
                ->with('message', 'Error:' . $e->getMessage());
        }

        return \Redirect::route('home')
            ->with('message', 'Post was successfully updated!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.delete', ['post' => $post]);
    }

    /**
     * @param int $id
     * @return \Redirect
     */
    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);

        try {
            $post->delete();
        } catch (\Exception $e) {
            return \Redirect::route('home')
                ->with('message', 'Error:' . $e->getMessage());
        }

        return \Redirect::route('home')
            ->with('message', 'Post was successfully deleted!');
    }
}
