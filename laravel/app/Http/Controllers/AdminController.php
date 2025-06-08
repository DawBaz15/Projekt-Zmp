<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class AdminController extends Controller {
    public function login(Request $request) {
        $email = $request->input('Email');
        $password = $request->input('Password');
        $auth = $request->input('Google2fa');
        $google2fa = new Google2FA();
        if (!isset($email,$password,$auth)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        $admin = Admin::where('Email', $email)->first();
        if (!$admin) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }
        if (!Hash::check($password,$admin->Password)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }
        if (!$admin->AccountActive) {
            return response([
                'message' => 'Account is not active'
            ], 403);
        }
        if ($google2fa->verifyKey($admin->Google2fa, $auth, 3)) {
            $token = Str::random(60);
            $admin::where('Email', $email)->update(['_token' => $token]);
            return response([
                'access_token' => $token,
                'message' => 'Login successful'
            ], 200);
        }
        return response([
            'message' => 'Bad request'
        ], 400);
    }

    public function create(Request $request) {
        $token = $request->input('Token');
        $email = $request->input('Email');
        $phone = $request->input('Phone');
        $name = $request->input('Name');
        $surname = $request->input('Surname');
        if (!isset($token, $email, $phone, $name, $surname)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::getAdminID($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        if (admin::where('Email', $email)->first()) {
            return response([
                'message' => 'Email taken'
            ], 400);
        }

        if (RequestChecker::accountCreation($email, $phone, $name, $surname)) {
            $google2fa = new Google2FA();
            $newAdmin = new Admin;
            $newAdmin->Email = $email;
            $newAdmin->Phone = $phone;
            $newAdmin->Name = $name;
            $newAdmin->Surname = $surname;
            $newAdmin->Password = Hash::make($phone);
            $newAdmin->AccountDate = date('Y/m/d', time());
            $newAdmin->Google2fa = $google2fa->generateSecretKey();
            $newAdmin->save();
            return response([
                'message' => 'Admin created'
            ], 201);
        }
        return response([
            'message' => 'Bad request'
        ], 400);
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
