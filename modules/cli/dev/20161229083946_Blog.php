<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Model\Blog as Blog;

class Blog extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('blog', function($table)
        {
            $table->increments('id');
            $table->int("name");
            $table->string("mama");
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('blog');
    }
}