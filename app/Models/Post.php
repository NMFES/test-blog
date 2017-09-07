<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * Post isn't published
     */
    const STATUS_NOTPUBLISHED = 0;

    /**
     * Post is published
     */
    const STATUS_PUBLISHED = 1;

//    protected $hidden = ['status', 'updated_at', 'created_at'];

    protected function getDateFormat() {
        return 'U';
    }

}
