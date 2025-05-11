<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class UserController extends Controller {
    public function login(Request $request) {
        $email = $request->header('Email');
        $password = $request->header('Password');
        $auth = $request->header('Google2fa');
        $google2fa = new Google2FA();
        if (!isset($email,$password,$auth)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        $user = User::where('Email', $email)->first();
        if (!$user) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }
        if (!Hash::check($password,$user->Password)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }
        if (!$user->AccountActive) {
            return response([
                'message' => 'Account is not active'
            ], 403);
        }
        if ($google2fa->verifyKey($user->Google2fa, $auth, 3)) {
            $token = Str::random(60);
            $user::where('Email', $email)->update(['_token' => $token]);
            return response([
                'access_token' => $token,
                'message' => 'Login successful'
            ], 200);
        }
        return response([
            'message' => 'Bad request'
        ], 400);
    }

    public function resetPassword(Request $request) {
        return response([
            'message' => 'User reset password'
        ], 200);
    }

    public function index(Request $request) {
        $token = $request->header('Token');
        if (!isset($token)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

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

    public function create(Request $request) {
        $token = $request->header('Token');
        $email = $request->header('Email');
        $phone = $request->header('Phone');
        $name = $request->header('Name');
        $surname = $request->header('Surname');
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

        if (user::where('Email', $email)->first()) {
            return response([
                'message' => 'Email taken'
            ], 400);
        }

        if (RequestChecker::accountCreation($email, $phone, $name, $surname)) {
            $google2fa = new Google2FA();
            $newUser = new User;
            $newUser->Email = $email;
            $newUser->Phone = $phone;
            $newUser->Name = $name;
            $newUser->Surname = $surname;
            $newUser->Password = Hash::make($phone);
            $newUser->AccountDate = date('Y/m/d', time());
            $newUser->Google2fa = $google2fa->generateSecretKey();
            $newUser->save();
            return response([
                'message' => 'User created'
            ], 201);
        }
        return response([
            'message' => 'Bad request'
        ], 400);
    }

    public function modify(Request $request) {
        $token = $request->header('Token');
        $userId = $request->header('UserId');
        $email = $request->header('Email');
        $phone = $request->header('Phone');
        $name = $request->header('Name');
        $surname = $request->header('Surname');
        $accountActive = $request->header('AccountActive');
        if (!isset($token, $userId)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!User::where('ID', $userId )->exists()) {
            return response([
                'message' => 'User not found'
            ], 404);
        }

        if (TokenChecker::getAdminID($token)) {
            if (isset($email) && RequestChecker::emailValidation($email)) {
                User::where("ID", $userId)->update(['Email'=>$email]);
            }
            if (isset($phone) && RequestChecker::phoneValidation($phone)) {
                User::where("ID", $userId)->update(['Phone'=>$phone]);
            }
            if (isset($name) && RequestChecker::stringValidation($name)) {
                User::where("ID", $userId)->update(['Name'=>$name]);
            }
            if (isset($surname) && RequestChecker::stringValidation($surname)) {
                User::where("ID", $userId)->update(['Surname'=>$surname]);
            }
            if (isset($accountActive) && RequestChecker::accountActiveValidation($accountActive)) {
                User::where("ID", $userId)->update(['AccountActive'=>$accountActive]);
            }
            return response([
                'message' => 'Modify successful'
            ], 200);
        }
        return response([
            'message' => 'Bad token'
        ], 401);
    }
}
