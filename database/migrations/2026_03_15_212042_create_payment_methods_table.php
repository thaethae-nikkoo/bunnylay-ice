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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('payment_method_id');
            $table->string('method_name', 30);
            $table->string('account_type', 50)->nullable();
            $table->string('logo_path', 255)->nullable();
            $table->string('account_name', 255)->nullable();
            $table->string('account_no', 150)->nullable();
            $table->tinyInteger('status')->comment('1: active 2:inactive');
            $table->bigInteger('created_by');
            $table->timestamp('created_at');
            $table->bigInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
