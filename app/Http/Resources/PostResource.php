<?php

namespace App\Http\Resources;

use App\Http\Resources\PostUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'user' => new PostUserResource($this->whenLoaded('user')),
            'href' => [
                'comments' => route("api.v1.posts.comments.index", ['post' => $this->id])
            ]
        ];
    }
}
