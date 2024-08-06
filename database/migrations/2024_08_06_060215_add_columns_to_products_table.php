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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('new')->after('price')->default(false);
            $table->boolean('hit')->after('price')->default(false);
            $table->boolean('sale')->after('price')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('new');
            $table->dropColumn('hit');
            $table->dropColumn('sale');
        });
    }
};
