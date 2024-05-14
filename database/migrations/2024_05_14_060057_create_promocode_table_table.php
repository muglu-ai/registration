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

        Schema::create('promocode_table', function (Blueprint $table) {
            $table->increments('id');     
            $table->string('promocode_organization')->index();
            $table->string('promo_code');
            $table->string('discount')->nullable();
            $table->string('total_count')->nullable();
            $table->string('total_used')->nullable();
            $table->string('remaining')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocode_table');
    }
};
