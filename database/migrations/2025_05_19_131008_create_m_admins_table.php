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
        Schema::create("m_admins", function (Blueprint $table) {
            $table->bigIncrements("admin_id");
            $table->string("name", 50);
            $table->string("username", 100)->unique();
            $table->string("password", 150);
            $table->string("phone", 20)->nullable();
            $table->tinyInteger("role")->default(1)->comment('1:admin 2:staff');
            $table->bigInteger("created_by");
            $table->bigInteger("updated_by")->nullable();
            $table->timestamp("created_at");
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("m_admins");
    }
};
