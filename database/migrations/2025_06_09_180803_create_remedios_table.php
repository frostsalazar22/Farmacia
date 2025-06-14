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
    Schema::create('remedios', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->integer('quantidade');
        $table->string('miligrama')->nullable();
        $table->date('validade')->nullable();
        $table->decimal('preco', 8, 2);
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
        Schema::dropIfExists('remedios');
    }
};
