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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->foreignId('customer_id');
            $table->string('contract');
            $table->string('package');
            $table->integer('price');
            $table->integer('qty');
            $table->decimal('tax', $precision = 2, $scale = 1);
            $table->integer('discount');
            $table->string('status');
            $table->timestamp('emailed_at')->nullable;
            $table->timestamp('deleted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
