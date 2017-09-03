<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected function getDateFormat() {
        return 'U';
    }

}
