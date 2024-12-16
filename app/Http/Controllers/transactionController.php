<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Wallet;
use Models\Transaction;

class transactionController extends Controller
{
    //
    public function sendMoney(Request $request) {
        $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'to_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
    
        $fromWallet = Wallet::findOrFail($request->from_wallet_id);
        $toWallet = Wallet::findOrFail($request->to_wallet_id);
        $amount = $request->amount;
    
        if ($fromWallet->balance < $amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }
    
        // Deduct from sender's wallet
        $fromWallet->balance -= $amount;
        $fromWallet->save();
    
        // Add to receiver's wallet
        $toWallet->balance += $amount;
        $toWallet->save();
    
        // Log transaction
        Transaction::create([
            'from_wallet_id' => $fromWallet->id,
            'to_wallet_id' => $toWallet->id,
            'amount' => $amount,
        ]);
    
        return response()->json(['message' => 'Transaction successful']);
    }
    
}
