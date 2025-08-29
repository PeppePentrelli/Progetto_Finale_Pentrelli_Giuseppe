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
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('surname');
        $table->string('address');
        $table->string('city');
        $table->string('postal_code');
        $table->string('province');
        $table->string('phone')->nullable();
        $table->text('notes')->nullable();
        $table->string('shipping_method');
        $table->decimal('total', 10, 2);
        $table->string('status')->default('in attesa');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
