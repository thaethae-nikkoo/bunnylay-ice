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
        Schema::create('mo_description_gps', function (Blueprint $table) {
            $table->bigIncrements('description_gp_id');
            $table->string('gp_name', 30);
            $table->tinyInteger('description_type')->comment('1: income 2:expense 3:both');
            $table->boolean('is_user_manual')->default(true);
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
        Schema::dropIfExists('mo_description_gps');
    }
};
