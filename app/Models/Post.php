<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    const STATUS_NOTPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

//    protected $hidden = ['status', 'updated_at', 'created_at'];

    protected function getDateFormat() {
        return 'U';
    }

}
