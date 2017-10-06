<?php

namespace App\Http\Services;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostService
 */
class PostService
{
    const IMAGES_PATH = '/images';

    /**
     * @param Post $post
     * @param Request $request
     * @return Post
     */
    public function fillPost(Post $post, Request $request)
    {
        $post->title = $request->title;
        $post->fullDescription = $request->fullDescription;
        $post->description = trim($request->description) ?: $this->makeBriefDescription($request->fullDescription);
        $post->image = '';

        if ($request->hasFile('image')) {
            $name = $this->saveImage($request->file('image'));
            $post->image = $name;
        }
        return $post;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function saveImage(UploadedFile $file)
    {
        $name = (Auth::user())->name . time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path(self::IMAGES_PATH);
        $file->move($destinationPath, $name);

        return $name;
    }

    /**
     * @param $fullDescription
     * @return string
     */
    public function makeBriefDescription($fullDescription)
    {
        $start = strpos($fullDescription, '<p>');
        $end = strpos($fullDescription, '</p>', $start);
        $paragraph = substr($fullDescription, $start, $end - $start + 4);
        $paragraph = html_entity_decode(strip_tags($paragraph));

        return $paragraph;
    }
}
