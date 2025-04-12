<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class AdminController extends Controller {
    public function login(Request $request) {
        return response([
            'message' => 'Admin login'
        ], 200);
    }
    public function resetPassword(Request $request) {
        return response([
            'message' => 'Admin reset password'
        ], 200);
    }
    public function notification() {
        return response([
            'message' => 'Admin notification'
        ], 200);
    }
}
