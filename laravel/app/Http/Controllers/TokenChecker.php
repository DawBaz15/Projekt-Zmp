<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Notifications\RaportReminder;

class TokenChecker {
    public static function getUserID(string $token) {
        $user = User::where('_token', $token)->value('ID');
        if (!$user) return null;

        $date = strtotime(User::where('_token', $token)->value('_tokenExpiry'));
        if($date > strtotime(date('Y/m/d H:i', time()))) {
            return $user;
        }
        return null;
    }
    public static function getAdminID(string $token) {
        $admin = Admin::where('_token', $token)->value('ID');
        if (!$admin) return null;

        $date = strtotime(Admin::where('_token', $token)->value('_tokenExpiry'));
        if($date > strtotime(date('Y/m/d H:i', time()))) {
            return $admin;
        }
        return null;
    }
    public static function checkIfValid(string $token) {
        $date = '0000-00-00';
        if (User::where('_token', $token)->exists()) {
            $date = strtotime(User::where('_token', $token)->value('_tokenExpiry'));
        }
        else if (Admin::where('_token', $token)->exists()) {
            $date = strtotime(Admin::where('_token', $token)->value('_tokenExpiry'));
        }
        if($date > strtotime(date('Y/m/d H:i', time()))) {
            return true;
        }
        return false;
    }
}
