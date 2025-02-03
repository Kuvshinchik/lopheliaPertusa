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
        Schema::create('tovars', function (Blueprint $table) {
            $table->id();
			$table->string('title', 256);
			$table->text('content');
			$table->unsignedInteger('status');
			$table->unsignedInteger('price');
			$table->string('categories', 256);
			$table->text('foto');
			$table->text('fotoforcategories');
			$table->unsignedInteger('nasklade');
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
        Schema::dropIfExists('tovars');
    }
};
