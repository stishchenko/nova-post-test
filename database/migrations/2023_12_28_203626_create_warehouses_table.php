<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->string('ref', 40)->primary();
            $table->string('city_ref', 40);
            $table->string('description');
            $table->string('description_ru');
            $table->timestamps();

            $table->foreign('city_ref')->references('ref')->on('cities')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
