<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'user_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });
        }

        
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('status')->default('En attente')->after('total');
            });
        }

       
        if (Schema::hasTable('reviews') && !Schema::hasColumn('reviews', 'user_id')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('product_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'user_id')) $table->dropColumn('user_id');
            if (Schema::hasColumn('orders', 'status'))  $table->dropColumn('status');
        });

        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'user_id')) $table->dropColumn('user_id');
        });
    }
};