<?php

use App\Models\Product;
use App\Models\User;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('code');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Product::class)->nullable();
            $table->string('credit_card')->nullable();
            $table->integer('total');
            $table->integer('biaya_admin');
            $table->integer('subtotal');
            $table->enum('type', ['investasi', 'deposit', 'withdraw']);
            $table->enum('status', ['paid', 'pending', 'unpaid'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('redirect_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
