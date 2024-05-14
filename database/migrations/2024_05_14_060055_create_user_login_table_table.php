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
        Schema::disableForeignKeyConstraints();

        Schema::create('user_login_table', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('exhibitor_id',15)->index();
            $table->string('login_email',250);
            $table->foreign('login_email',250)->references('cp_email',250)->on('exhibitor_reg_table');
            $table->string('password')->comment('Auto generate on some random pattern and a common(hardcoded) password');
            $table->foreign('exhibitor_id')->references('exhibitor_id')->on('exhibitor_reg_table');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_login_table');
    }
};
