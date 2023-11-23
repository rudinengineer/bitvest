<?php

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
        Schema::create('deposits', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->foreignIdFor(User::class);
            $table->integer('total');
            // $table->enum('payment_method', ['qris']);
            $table->enum('status', ['paid', 'pending', 'unpaid'])->default('pending');
            $table->dateTime('expired')->default(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 3 hours')));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
