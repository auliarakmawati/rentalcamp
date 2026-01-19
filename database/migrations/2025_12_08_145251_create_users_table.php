<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
    $table->id(); // default: id
    $table->string('name'); // default name, bukan nama
    $table->string('email')->unique();
    $table->string('password');
    $table->string('address')->nullable(); // bebas, boleh alamat
    $table->string('phone')->nullable();   // bebas, boleh no_hp
    $table->string('role')->default('user');
    $table->rememberToken();
    $table->timestamps();
});

}
};
