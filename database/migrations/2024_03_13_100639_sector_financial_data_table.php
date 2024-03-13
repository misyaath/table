<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_data_by_sectors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('segment');
            $table->string('country');
            $table->string('product');
            $table->string('discount_band');
            $table->decimal('units_sold');
            $table->float('manufacturing_price');
            $table->float('sale_price');
            $table->double('gross_sale');
            $table->float('discounts');
            $table->double('sales');
            $table->double('cogs');
            $table->double('profit');
            $table->integer('month_number');
            $table->string('month_name');
            $table->integer('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_data_by_sectors');
    }
};
