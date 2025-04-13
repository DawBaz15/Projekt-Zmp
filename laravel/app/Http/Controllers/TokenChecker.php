<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;

class TokenChecker {
    public static function getUserID(string $token) {
        return User::where('_token', $token)->value('ID');
    }
    public static function getAdminID(string $token) {
        return Admin::where('_token', $token)->value('ID');
    }
    public static function checkIfValid(string $token) {
        if (User::where('_token', $token)->exists()) {
            return true;
        }
        if (Admin::where('_token', $token)->exists()) {
            return true;
        }
        return false;
    }
}
