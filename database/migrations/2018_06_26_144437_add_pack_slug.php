<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackSlug extends Migration
{
    public function up()
    {
        Schema::table('packs', function (Blueprint $table) {
            $table->string('slug')->default('none');
        });
    }

    public function down()
    {
        Schema::table('packs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
