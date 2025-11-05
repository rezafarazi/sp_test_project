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
        Schema::create('reports_tbls', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('file_addres');
            $table->string('status');
            $table->string('datetime');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports_tbls');
    }
};
