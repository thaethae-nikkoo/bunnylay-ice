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
        Schema::create('mo_descriptions', function (Blueprint $table) {
            $table->bigIncrements('description_id');
            $table->bigInteger('description_gp_id')->unsigned();
            $table->string('name', 30);
            $table->boolean('is_user_manual')->default(true);
            $table->bigInteger('created_by');
            $table->timestamp('created_at');
            $table->bigInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('description_gp_id')->references('description_gp_id')->on('mo_description_gps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mo_descriptions');
    }
};
