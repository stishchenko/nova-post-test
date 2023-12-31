<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->string('ref', 40)->primary();
            $table->string('description');
            $table->string('description_ru');
            $table->string('settlement_type_description');
            $table->string('settlement_type_description_ru');
            $table->string('area_description');
            $table->string('area_description_ru');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
