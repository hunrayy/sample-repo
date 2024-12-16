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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wallet_type_id')->constrained('wallet_types')->onDelete('cascade');
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
        });

        // Array of users
        $users = [
            ['name' => 'John Doe', 'email' => 'johndoe@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'email' => 'janesmith@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'John Smith', 'email' => 'johnsmith@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Elizabeth Miller', 'email' => 'elizabethmiller@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Henry Williams', 'email' => 'henrywilliams@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olivia Brown', 'email' => 'oliviabrown@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Noah Rodriguez', 'email' => 'noahrodriguez@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amelia Hernandez', 'email' => 'ameliahernandez@gmail.com', 'password' => bcrypt('password'), 'created_at' => now(), 'updated_at' => now()],
        ];

        // Fetch all wallet types
        $walletTypes = DB::table('wallet_types')->get();

        if ($walletTypes->isEmpty()) {
            throw new Exception("No wallet types available. Please seed the wallet_types table first.");
        }

        $userIndex = 0;

        foreach ($walletTypes as $walletType) {
            // Insert user if available, else stop assigning wallets
            if (!isset($users[$userIndex])) {
                break;
            }
    
            $user = $users[$userIndex];
            $userId = DB::table('users')->insertGetId($user);
    
            DB::table('wallets')->insert([
                'user_id' => $userId,
                'wallet_type_id' => $walletType->id,
                'balance' => $walletType->minimum_balance * 2, // Adding extra funds for transactions
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            $userIndex++;
        }

        // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $userId = DB::table('users')->where('email', 'johndoe@gmail.com')->value('id');
        // $walletTypeId = DB::table('wallet_types')->where('name', 'Premium Wallet')->value('id');
        // $minimumBalance = DB::table('wallet_types')->where('name', 'Premium Wallet')->value('minimum_balance');
        // DB::table('wallets')->insert([
        //     'user_id' => $userId, 
        //     'wallet_type_id' => $walletTypeId,  
        //     'balance' => $minimumBalance * 2, // Adding some extra funds for transactions,
        // ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
