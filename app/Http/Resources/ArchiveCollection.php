<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArchiveCollection extends ResourceCollection
{
    use Helpers;

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($archives) {
                return $archives->map(function ($archive) {
                    return [
                        'id' => $archive->id,
                        'title' => $archive->title,
                        'created_at' => Carbon::parse($archive->created_at)->format('M, j'),
                    ];
                });
            }),
        ];
    }
}
