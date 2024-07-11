<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdAndSocialLinksToContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('slug')->unique()->after('type')->nullable();
            $table->json('social_links')->after('slug')->nullable();
            $table->json('boucher_files')->after('social_links')->nullable();
            $table->json('get_in_touch')->after('boucher_files')->nullable();
            $table->unsignedBigInteger('category_id')->after('get_in_touch')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('slug');
            $table->dropColumn('social_links');
            $table->dropColumn('boucher_files');
            $table->dropColumn('get_in_touch');
            $table->dropColumn('category_id');
        });
    }
}
