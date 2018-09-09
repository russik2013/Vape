<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function(Blueprint $table){
           $table->integer('setting_type_id')->unsigned();
           $table->foreign('setting_type_id')->references('id')->on('setting_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table){
            $table->dropForeign(['setting_type_id']);
            $table->dropColumn('setting_type_id');
        });
    }
}
