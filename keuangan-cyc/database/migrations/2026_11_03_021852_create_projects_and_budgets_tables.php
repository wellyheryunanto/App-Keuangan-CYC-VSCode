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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('business_division_id')->constrained()->restrictOnDelete();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('manager_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('code', 40);
            $table->string('name', 200);
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('target_completion_date')->nullable();
            $table->string('status', 20)->default('planning');
            $table->timestamps();

            $table->unique(['company_id', 'code']);
            $table->index(['business_division_id', 'status']);
            $table->index(['client_id', 'status']);
        });

        Schema::create('project_members', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('project_role', 30);
            $table->timestampTz('assigned_at')->useCurrent();

            $table->primary(['project_id', 'user_id']);
            $table->index(['user_id', 'project_role']);
        });

        Schema::create('project_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->restrictOnDelete();
            $table->foreignId('supersedes_id')->nullable()->constrained('project_contracts')->nullOnDelete();
            $table->unsignedSmallInteger('version_number');
            $table->string('contract_number', 60)->nullable();
            $table->date('signed_date')->nullable();
            $table->date('effective_date')->nullable();
            $table->decimal('contract_value', 20, 2);
            $table->string('status', 20)->default('draft');
            $table->text('file_path')->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'version_number']);
            $table->index(['project_id', 'status']);
        });

        Schema::create('project_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->restrictOnDelete();
            $table->foreignId('supersedes_id')->nullable()->constrained('project_budgets')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedSmallInteger('revision_number');
            $table->string('status', 20)->default('draft');
            $table->date('effective_date')->nullable();
            $table->timestampTz('approved_at')->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'revision_number']);
            $table->index(['project_id', 'status']);
        });

        Schema::create('project_budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_budget_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transaction_category_id')->constrained()->restrictOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('description', 255);
            $table->decimal('quantity', 18, 4)->default(1);
            $table->decimal('unit_price', 20, 2);
            $table->decimal('tax_amount', 20, 2)->default(0);
            $table->decimal('line_total', 20, 2);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['project_budget_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_budget_items');
        Schema::dropIfExists('project_budgets');
        Schema::dropIfExists('project_contracts');
        Schema::dropIfExists('project_members');
        Schema::dropIfExists('projects');
    }
};
