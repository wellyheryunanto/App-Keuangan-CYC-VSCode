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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('code', 30);
            $table->string('name', 200);
            $table->string('contact_person', 150)->nullable();
            $table->string('tax_number', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'name']);
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('code', 30);
            $table->string('name', 200);
            $table->string('contact_person', 150)->nullable();
            $table->string('tax_number', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'name']);
        });

        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('chart_of_accounts')->nullOnDelete();
            $table->string('code', 30);
            $table->string('name', 150);
            $table->string('account_type', 20);
            $table->string('normal_balance', 6);
            $table->boolean('is_postable')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'account_type']);
        });

        Schema::create('cash_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('chart_of_account_id')->unique()->constrained()->restrictOnDelete();
            $table->string('code', 30);
            $table->string('name', 100);
            $table->string('account_type', 12);
            $table->string('bank_name', 100)->nullable();
            $table->text('account_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'account_type']);
        });

        Schema::create('transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('transaction_categories')->nullOnDelete();
            $table->foreignId('default_account_id')->nullable()->constrained('chart_of_accounts')->restrictOnDelete();
            $table->string('code', 30);
            $table->string('name', 100);
            $table->string('direction', 12);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'code']);
            $table->index(['company_id', 'direction']);
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
        Schema::dropIfExists('transaction_categories');
        Schema::dropIfExists('cash_accounts');
        Schema::dropIfExists('chart_of_accounts');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('clients');
    }
};
