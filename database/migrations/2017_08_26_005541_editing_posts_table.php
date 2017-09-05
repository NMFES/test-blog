<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditingPostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->after('title');
            $table->text('content')->after('description');
            $table->string('meta_description')->after('content');
            $table->string('meta_keywords')->after('meta_description');
            $table->tinyInteger('status')->unsigned()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['description', 'content', 'meta_description', 'meta_keywords', 'status']);
        });
    }

}
