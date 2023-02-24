<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplies', function (Blueprint $table) {
            
            $table->text('p1q1')->nullable()->change();
            $table->text('p2q1')->nullable()->change();
            $table->text('p3q1')->nullable()->change();
            $table->text('p1q2')->nullable()->change();
            $table->text('p2q2')->nullable()->change();
            $table->text('p3q2')->nullable()->change();
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
