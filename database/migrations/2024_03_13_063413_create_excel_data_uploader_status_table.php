<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('excel_data_uploader_status', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('file_path');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('excel_data_uploader_status');
    }
};
