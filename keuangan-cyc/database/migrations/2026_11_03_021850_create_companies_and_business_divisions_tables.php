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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('legal_name', 200)->nullable();
            $table->string('tax_number', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->char('currency_code', 3)->default('IDR');
            $table->string('timezone', 64)->default('Asia/Jakarta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('business_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('code', 20);
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_divisions');
        Schema::dropIfExists('companies');
    }
};
