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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('idTovar');
			$table->unsignedBigInteger('idUser');
			$table->unsignedInteger('status');
            $table->timestamps();
			
			$table->index('idTovar');
			$table->index('idUser');
			// внешний ключ, ссылается на поле id таблицы users
            $table->foreign('idUser')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
			
			// внешний ключ, ссылается на поле id таблицы 	tovars
            $table->foreign('idTovar')
                  ->references('id')
                  ->on('tovars')
                  ->onDelete('cascade');	  
        });
    }
	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
