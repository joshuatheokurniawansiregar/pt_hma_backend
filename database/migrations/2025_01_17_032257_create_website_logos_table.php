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
        Schema::create('website_logos', function (Blueprint $table) {
            $table->id();
            $table->string("logo_file_path");
            $table->string("logo_file_name",255);
            $table->string("logo_file_link", 255);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_logos');
    }
};
