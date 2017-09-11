<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller {

    /**
     * Index page
     * @return json
     */
    public function index(Request $request) {
        return response()
                        ->json(Post::getPosts($request));
    }

    /**
     * Show post page
     * @param string $slug
     * @return json
     */
    public function show($slug) {
        return response()
                        ->json(Post::getPost($slug));
    }

}
