<?php

use App\src\Domain\CSV\Enums\CSVDataProcessStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->uuid('file');
            $table->string('description');
            $table->enum('status', CSVDataProcessStatus::statuses());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
