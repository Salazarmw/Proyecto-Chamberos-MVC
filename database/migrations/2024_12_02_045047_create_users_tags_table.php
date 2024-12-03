<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idChambero')->unsigned();
            $table->bigInteger('idTags')->unsigned();
            $table->foreign('idChambero')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('idTags')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_tags');
    }
};
