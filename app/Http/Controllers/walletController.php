<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class walletController extends Controller
{
    //
    public function getAllWallets() {
        try{
            // return Wallet::with('user', 'walletType')->get();
            $allWalletdetails =  Wallet::with('user', 'walletType')->get();
            return response()->json([
                'message' => 'all wallet details retrieved successfully',
                'code' => 'success',
                'data' => $allWalletdetails
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'an error occured while retrieving all wallet details: ' . $e,
                'code' => 'error',
            ]);
        }
    }

    public function getWalletDetails($id) {
        try{
            // $wallet = Wallet::with('user', 'walletType')->findOrFail($id);
            $singleWalletById = Wallet::with('user', 'walletType')->findOrFail($id);
    
            return response()->json([
                'message' => 'single wallet details successfully retrieved by id',
                'code' => 'success',
                'data' => $singleWalletById
            ]);

        }catch (ModelNotFoundException $e) {
            // Catch the case when wallet with ID is not found
            return response()->json([
                'message' => 'No wallet found with ID: ' . $id,
                'code' => 'error',
            ], 404); // 404 Not Found

        }catch(Exception $e){
            return response()->json([
                'message' => 'an error occured while retrieving single wallet details by id: ' . $e,
                'code' => 'error',
            ]);
        }
    }
    
    
}
