<?php

namespace App\Http\Controllers\Api\V1;

use App\{Comment, Post};
use App\Http\Resources\PostCommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Post\StorePostComment;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $perPage = $request->input('per_page') ?? 15;
        return PostCommentResource::collection($post->comments()->with('user')->paginate($perPage)
            ->appends(
                ['per_page' => $perPage]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, StorePostComment $request)
    {
        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);

        return new PostCommentResource($comment->load(['post', 'user', 'post.user']));
    }
}
