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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //IDX
            $table->index('category_id', 'expenses_category_expenses_idx');
            $table->index('user_id', 'expenses_users_idx');


            // FK
            $table->foreign('category_id', 'expenses_category_expenses_fk')->on('category_expenses')->references('id');
            $table->foreign('user_id', 'expenses_users_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
