<?php

namespace App\Http\Controllers\API\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class DeleteTag extends Controller
{
    public function __invoke(int $id)
    {
        $tag = Tag::query()->findOrFail($id);
        $tag->delete();

        return $this->response->noContent();
    }
}
