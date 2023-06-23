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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->integer('contract_number');
            $table->string('package');
            $table->integer('price');
            $table->integer('qty');
            $table->string('description', 500);
            $table->date('contract_date');
            $table->date('contract_begin');
            $table->date('contract_end');
            $table->string('status');
            $table->date('sent');
            $table->date('signed');
            $table->date('done');
            $table->date('cancel');
            $table->string('pdf');
            $table->timestamp('deleted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
