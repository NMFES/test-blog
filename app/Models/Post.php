<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Elasticsearch\ClientBuilder;

class Post extends Model {

    /**
     * Elasticsearch index name
     */
    const ES_INDEX = 'posts_index';

    /**
     * Post isn't published
     */
    const STATUS_NOTPUBLISHED = 0;

    /**
     * Post is published
     */
    const STATUS_PUBLISHED = 1;

    private static $_esClient;

//    protected $hidden = ['status', 'updated_at', 'created_at'];

    protected function getDateFormat() {
        return 'U';
    }

    /**
     * Returns all posts for index page
     * @param Request $request
     * @return array
     */
    public static function getPosts(Request $request) {
        $query = $request->header('Query');

        $posts = self::where('status', self::STATUS_PUBLISHED)
                ->select('id', 'title', 'description', 'slug', 'created_at');

        $ids = [];

        if (!empty($query)) {
            $query = preg_replace("/[\\+\\-\\=\\&\\|\\!\\(\\)\\{\\}\\[\\]\\^\\\"\\~\\*\\<\\>\\?\\:\\\\\\/]/", addslashes('\\$0'), $query);

            $params = [
                'index' => self::ES_INDEX,
                'type' => 'post',
                'body' => [
                    'query' => [
                        'wildcard' => [
                            'title' => [
                                'value' => $query . '*'
                            ]
                        ]
                    ]
                ],
                'size' => 1000,
            ];

            $results = self::getESClient()->search($params);

            // collect ids
            if ($results['hits']['total']) {
                foreach ($results['hits']['hits'] as $hit) {
                    $ids[] = $hit['_id'];
                }

                $posts->whereIn('id', $ids)
                        ->orderByRaw("FIELD(id, " . (implode(',', $ids)) . ")");
            } else {
                $posts->whereIn('id', count($ids) ? $ids : [0]);
            }
        }

        $posts = $posts->paginate(10)->toArray();

        foreach ($posts['data'] as $key => $post) {
            $posts['data'][$key]['created_at'] = Carbon::createFromTimestamp($post['created_at'])->format('Y-m-d, H:i');

            if (Storage::disk('public')->exists('images/posts/' . $post['id'] . '.jpg')) {
                $posts['data'][$key]['img'] = Storage::disk('public')->url('images/posts/' . $post['id'] . '.jpg');
            } else {
                $posts['data'][$key]['img'] = Storage::disk('public')->url('images/other/noimage_medium.png');
            }
        }

        return $posts;
    }

    /**
     * Returns searched post for show page
     * @param type $slug
     * @return array
     */
    public static function getPost($slug) {
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

        return $post;
    }

    /**
     * Creates index
     */
    public static function createIndex() {
        $params = [
            'index' => self::ES_INDEX,
            'body' => [
                'mappings' => [
                    'post' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'title' => [
                                'type' => 'string',
                                'analyzer' => 'standard'
                            ]
                        ]
                    ]
                ]
            ]
        ];


        // Create the index with mappings and settings now
        $response = self::getESClient()->indices()->create($params);
    }

    /**
     * Deletes index
     */
    public static function deleteIndex() {
        $params = ['index' => self::ES_INDEX];

        $response = self::getESClient()->indices()->delete($params);
    }

    /**
     * Runs full reindex
     */
    public static function reindex() {
        $posts = self::where('status', self::STATUS_PUBLISHED)
                ->select('id', 'title')
                ->get();

        $params = [
            'index' => self::ES_INDEX,
            'type' => 'post',
            'id' => 0,
            'body' => [
                'title' => ''
            ]
        ];

        foreach ($posts as $post) {
            $params['id'] = $post->id;
            $params['body']['title'] = $post->title;

            $response = self::getESClient()->index($params);
        }
    }

    /**
     * Returns ClientBuilder object
     * @return ClientBuilder
     */
    public static function getESClient() {
        if (!self::$_esClient) {
            self::$_esClient = ClientBuilder::create()->build();
        }

        return self::$_esClient;
    }

}
