<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class TransactionController extends Controller
{
    public function sendMoney(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'to_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
    
        try {
            // Fetch wallets and amount
            $fromWallet = Wallet::findOrFail($request->from_wallet_id);
            $toWallet = Wallet::findOrFail($request->to_wallet_id);
            $amount = $request->amount;

            $toUserDetails = User::where('id', $toWallet->id)->first();
    
            // Check if sender has sufficient balance
            if ($fromWallet->balance < $amount) {
                return response()->json(['message' => 'Opps, looks like you have an insufficient balance', 'code' => 'error'], 400);
            }

            //check if the user is trying to send money to his/her wallet
            if($fromWallet == $toWallet){
                return response()->json([
                    'message' => 'You cannot send money to your own wallet, Please select a different wallet to send money to.',
                    'code' => 'error'
                ]);
            };
    
            // Deduct from sender's wallet
            $fromWallet->balance -= $amount;
            $fromWallet->save();
    
            // Add to receiver's wallet
            $toWallet->balance += $amount;
            $toWallet->save();
    
            // Log the transaction
            $transaction = Transaction::create([
                'from_wallet_id' => $fromWallet->id,
                'to_wallet_id' => $toWallet->id,
                'amount' => $amount,
            ]);
    
            return response()->json(['message' => "Transaction completed successfully!. You have successfully transfered $$amount to $toUserDetails->name", 'code' => 'success', 'data' => $transaction]);
        
        } catch (ModelNotFoundException $e) {
            // Handle wallet not found exception
            return response()->json([
                'error' => 'Wallet not found. Please check the wallet IDs.',
                'code' => 'error'
            ], 404);
        } catch (Exception $e) {
            // Handle any unexpected errors
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage(),
                'code' => 'error'
            ], 500);
        }
    }
}

