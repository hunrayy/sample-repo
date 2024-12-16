<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Model\Wallet;
class walletController extends Controller
{
    //
    public function getAllWallets() {
        return Wallet::with('user', 'walletType')->get();
    }

    public function getWalletDetails($id) {
        $wallet = Wallet::with('user', 'walletType')->findOrFail($id);
        return $wallet;
    }
    
    
}
