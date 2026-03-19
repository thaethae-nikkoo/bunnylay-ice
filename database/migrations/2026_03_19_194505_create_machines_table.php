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
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('machine_id');
            $table->string('machine_name', 100);
            $table->string('product_type')->comment('1 ice block, 2 ice tube, 3 ice cube, 4 flake ice');
            $table->string('status')->comment('1 active, 2 inactive')->default(1);
            $table->string('code', 20)->nullable();
            $table->string('capacity_mode')->comment('hour,shift,day,night,whole_day');
            $table->float('capacity_value')->comment('capacity value per hour,shift,day,night,whole_day');
            $table->string('location', 150)->nullable();
            $table->string('remark', 255)->nullable();
            $table->string('photo_path')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
