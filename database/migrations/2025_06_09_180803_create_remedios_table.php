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
        $table->string('Nome');
        $table->integer('Quantidade');
        $table->string('Miligrama')->nullable(); // exemplo: "500mg" ou "20g"
        $table->date('Validade')->nullable();
        $table->decimal('Preco', 8, 2);
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
