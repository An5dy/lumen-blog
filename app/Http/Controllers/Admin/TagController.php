<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function __invoke($id)
    {
        $tag = Tag::query()->findOrFail($id);
        $tag->delete();

        return $this->response->noContent();
    }
}
