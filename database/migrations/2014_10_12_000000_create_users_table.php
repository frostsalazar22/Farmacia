<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('funcionario');
            $table->timestamps();
        });

        // Inserção de usuários padrão
        DB::table('users')->insert([
            [
                'name' => 'Henrique',
                'email' => 'henrique@example.com',
                'password' => Hash::make('senha123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Tales',
                'email' => 'tales@example.com',
                'password' => Hash::make('senha123'),
                'role' => 'funcionario',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
