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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //IDX
            $table->index('category_id', 'incomes_category_incomes_idx');
            $table->index('user_id', 'incomes_users_idx');

            // FK
            $table->foreign('category_id', 'incomes_category_incomes_fk')->on('category_incomes')->references('id');
            $table->foreign('user_id', 'incomes_users_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
