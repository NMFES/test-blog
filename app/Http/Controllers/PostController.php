<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller {

    /**
     * Index page
     * @return json
     */
    public function index(Request $request) {
        $query = $request->header('Query');

        $posts = Post::where('status', Post::STATUS_PUBLISHED)
                ->where('title', 'like', '%' . $query . '%')
                ->select('id', 'title', 'description', 'slug', 'created_at')
                ->addBinding($query)
                ->paginate(10)
                ->toArray();

        foreach ($posts['data'] as $key => $post) {
            $posts['data'][$key]['created_at'] = Carbon::createFromTimestamp($post['created_at'])->format('Y-m-d, H:i');

            if (Storage::disk('public')->exists('images/posts/' . $post['id'] . '.jpg')) {
                $posts['data'][$key]['img'] = Storage::disk('public')->url('images/posts/' . $post['id'] . '.jpg');
            } else {
                $posts['data'][$key]['img'] = Storage::disk('public')->url('images/other/noimage_medium.png');
            }
        }

        return response()->json($posts);
    }

    /**
     * Show post page
     * @param string $slug
     * @return json
     */
    public function show($slug) {
        $post = Post::where(['slug' => $slug, 'status' => Post::STATUS_PUBLISHED])
                ->select('id', 'title', 'content', 'created_at')
                ->firstOrFail()
                ->toArray();

        $post['created_at'] = Carbon::createFromTimestamp($post['created_at'])->format('Y-m-d, H:i');


        if (Storage::disk('public')->exists('images/posts/' . $post['id'] . '.jpg')) {
            $post['img'] = Storage::disk('public')->url('images/posts/' . $post['id'] . '.jpg');
        } else {
            $post['img'] = '';
        }

        return response()->json($post);
    }

}
