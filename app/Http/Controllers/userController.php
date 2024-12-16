<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\User;

class userController extends Controller
{
    //
    public function getAllUsers() {
        return User::all();
    }
}
