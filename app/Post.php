<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
