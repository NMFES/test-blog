<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function __construct() {
        $this->middleware('auth:api')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $comments = Comment::select('id', 'parent_id', 'name', 'message', 'created_at')
                        ->get()->sortBy('id')->toArray();

        $parentIDs = [];

        foreach ($comments as $key => $comment) {
            $comments[$key]['created_at'] = Carbon::createFromTimestamp($comment['created_at'])->format('Y-m-d, H:i:s');
            $comments[$key]['img'] = 'https://randomuser.me/api/portraits/' . (mt_rand(0, 1) ? 'women' : 'men') . '/' . mt_rand(1, 99) . '.jpg';

            if ($comment['parent_id'] && !in_array($comment['parent_id'], $parentIDs)) {
                $parentIDs[] = $comment['parent_id'];
            }
        }

        $newArray = [];

        $this->sortComments($newArray, $comments, $parentIDs);

        return response()->json($newArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'message' => 'required|string|min:10|max:5000',
            'parent_id' => 'required|integer' . ((bool) $request->parent_id ? '|exists:comments,id' : '')
        ]);
        
        $comment = new Comment();
        $comment->name = Auth::user()->name;
        $comment->message = $request->message;
        $comment->parent_id = $request->parent_id;

        $comment->save();

        return response()->json([
                    'success' => true,
        ]);
    }

    /**
     * Sorts comments in tree order
     * @param array $newArray
     * @param array $sourceArray
     * @param array $parentIDs
     * @param integer $parentID
     * @param integer $level
     */
    private function sortComments(&$newArray, &$sourceArray, &$parentIDs, $parentID = 0, $level = 0) {
        foreach ($sourceArray as $comment) {
            if ($parentID != $comment['parent_id']) {
                continue;
            }

            $comment['level'] = ($level <= 3) ? $level : 3;

            $newArray[] = $comment;

            // if current comment has some nested comments
            if (in_array($comment['id'], $parentIDs)) {
                $this->sortComments($newArray, $sourceArray, $parentIDs, $comment['id'], ($level + 1));
            }
        }
    }

}
