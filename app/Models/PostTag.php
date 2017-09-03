<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model {

    // disable default timestamps
    public $timestamps = false;

    protected function getDateFormat() {
        return 'U';
    }

}
