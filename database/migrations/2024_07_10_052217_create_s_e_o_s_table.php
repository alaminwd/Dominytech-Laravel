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
        Schema::create('s_e_o_s', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('title');
            $table->string('slug');
            $table->string('author');
            $table->string('keywords');
            $table->string('canonical');
            $table->string('og_locale');
            $table->string('og_url');
            $table->string('og_type');
            $table->string('image')->nullable();
            $table->string('desp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_e_o_s');
    }
};
