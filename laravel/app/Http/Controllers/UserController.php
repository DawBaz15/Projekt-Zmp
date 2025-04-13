<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function index(Request $request) {
        $token = $request->header('Token');
        if (isset($token)) {
            if (TokenChecker::getAdminID($token)) {
                return response([
                    'message' => 'Array fetched',
                    'array' => User::all()
                ], 200);
            }
            return response([
                'message' => 'Bad token'
            ], 401);
        }
        return response([
            'message' => 'Bad request'
        ], 400);
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
