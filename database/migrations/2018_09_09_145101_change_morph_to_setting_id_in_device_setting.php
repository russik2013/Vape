<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMorphToSettingIdInDeviceSetting extends Migration
{
    private $current_table_name = 'devise_settings';
    private $new_table_name = 'device_setting';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->current_table_name, function(Blueprint $table){
            $table->dropMorphs('devices');
            $table->morphs('device');
            $table->dropMorphs('settings');
            $table->integer('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('settings');
        });

        Schema::rename($this->current_table_name, $this->new_table_name);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename( $this->new_table_name, $this->current_table_name );

        Schema::table($this->current_table_name, function(Blueprint $table){
            $table->dropForeign(['setting_id']);
            $table->dropColumn('setting_id');
            $table->morphs('settings');
            $table->dropMorphs('device');
            $table->morphs('devices');
        });
    }
}
