<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class UserController extends Controller {
    public function login(Request $request) {
        return response([
            'message' => 'User login'
        ], 200);
    }
    public function resetPassword(Request $request) {
        return response([
            'message' => 'User reset password'
        ], 200);
    }
    public function index() {
        return response([
            'message' => 'User index'
        ], 200);
    }
    public function create(Request $request) {
        return response([
            'message' => 'User create'
        ], 200);
    }
    public function modify(Request $request) {
        return response([
            'message' => 'User modify'
        ], 200);
    }
}
