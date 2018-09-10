<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersToTanksVp16 extends Migration
{
    private $current_table_name = 'users_to_tanks';
    private $new_table_name = 'device_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'users_to_tanks', function( Blueprint $table ){
            $table->dropForeign( [ 'tank_id' ] );
            $table->dropColumn( 'tank_id' );
            $table->morphs( 'device' );
        });

        Schema::rename( $this->current_table_name, $this->new_table_name );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename( $this->new_table_name, $this->current_table_name );

        Schema::table( 'users_to_tanks', function(Blueprint $table){
            $table->dropMorphs( 'device' );
            $table->integer( 'tank_id' )->unsigned();
            $table->foreign( 'tank_id' )->references( 'id' )->on( 'tanks' );
        });
    }
}
