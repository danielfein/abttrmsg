<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('messages', function(Blueprint $table)
      {
         $table->integer('layout_type');
          });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
            Schema::drop('messages');
  }
}
