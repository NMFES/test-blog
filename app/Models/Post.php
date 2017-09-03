<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected function getDateFormat() {
        return 'U';
    }

}
