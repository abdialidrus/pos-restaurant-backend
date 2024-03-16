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
        Schema::table('users', function (Blueprint $table) {
            // role enum (OWNER, ADMIN, CASHIER, STAFF) default STAFF
            $table->enum('role', ['owner', 'admin', 'cashier', 'staff'])->default('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop column ROLE
            $table->dropColumn('role');
        });
    }
};
