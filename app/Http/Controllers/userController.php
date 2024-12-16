<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    //
    public function getAllUsers() {
        try{
            // return User::all();
            $allUsers =  User::all();
            return response()->json([
                'message' => 'All users successfully retrieved',
                'code' => 'success',
                'data' => $allUsers
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving all users: ' . $e->getMessage(),
                'code' => 'error',
            ]);
        }
    }
}
