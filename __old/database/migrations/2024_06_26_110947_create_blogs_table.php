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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
			$table->string('title', 256);
			$table->text('content');
			$table->unsignedInteger('status');
			$table->text('foto');
			$table->text('comment');
			$table->string('autorComment', 256);
			$table->string('dateComment', 256);
			$table->string('socialNetworkComment', 256);
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
        Schema::dropIfExists('blogs');
    }
};
