<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_account_id');
            $table->unsignedBigInteger('destination_account_id');
            $table->unsignedBigInteger('amount');
            $table->timestamps();

            $table->foreign('origin_account_id')->references('id')->on('accounts');
            $table->foreign('destination_account_id')->references('id')->on('accounts');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferences');
    }
}
