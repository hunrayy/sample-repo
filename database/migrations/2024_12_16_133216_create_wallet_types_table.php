<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallet_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('minimum_balance', 10, 2);
            $table->decimal('monthly_interest_rate', 5, 2);
            $table->timestamps();
        });

        // Insert data manually
        DB::table('wallet_types')->insert([
            [
                'name' => 'Premium Wallet',
                'minimum_balance' => 5000.00,
                'monthly_interest_rate' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic Wallet',
                'minimum_balance' => 1000.00,
                'monthly_interest_rate' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silver Wallet',
                'minimum_balance' => 2000.00,
                'monthly_interest_rate' => 1.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gold Wallet',
                'minimum_balance' => 10000.00,
                'monthly_interest_rate' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Platinum Wallet',
                'minimum_balance' => 50000.00,
                'monthly_interest_rate' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student Wallet',
                'minimum_balance' => 500.00,
                'monthly_interest_rate' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Wallet',
                'minimum_balance' => 20000.00,
                'monthly_interest_rate' => 3.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Corporate Wallet',
                'minimum_balance' => 100000.00,
                'monthly_interest_rate' => 5.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_types');
    }
};
