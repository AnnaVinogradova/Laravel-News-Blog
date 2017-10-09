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
        $oldImageName = $post->image ?: null;

        if ($request->hasFile('image')) {
            $name = $this->saveImage($request->file('image'), $oldImageName);
            $post->image = $name;
        } elseif ($oldImageName === null) {
            $post->image = '';
        }

        return $post;
    }

    /**
     * @param UploadedFile $file
     * @param string|null $oldImage
     * @return null|string
     */
    private function saveImage(UploadedFile $file, string $oldImage = null)
    {
        try {
            $name = (Auth::user())->name . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path(self::IMAGES_PATH);
            $file->move($destinationPath, $name);

            if ($oldImage !== null) {
                \File::delete(public_path(self::IMAGES_PATH), $oldImage);
            }
        } catch (\Exception $e) {
            return null;
        }

        return $name;
    }

    /**
     * @param string $fullDescription
     * @return string
     */
    public function makeBriefDescription(string $fullDescription)
    {
        $start = strpos($fullDescription, '<p>');
        $end = strpos($fullDescription, '</p>', $start);
        $paragraph = substr($fullDescription, $start, $end - $start + 4);
        $paragraph = html_entity_decode(strip_tags($paragraph));

        return $paragraph;
    }
}
