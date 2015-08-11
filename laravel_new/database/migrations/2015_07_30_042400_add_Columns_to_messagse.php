<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMessagse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::table('messages', function($table) {
              $table->integer('type_block1');
              $table->string('content_block1');
          });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
          //
      }

    }
