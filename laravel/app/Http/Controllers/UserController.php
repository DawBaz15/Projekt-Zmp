<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

// do dodania: hashowanie hasła, generowanie tokenu, resetowania hasła mailem, google2fa przy logowaniu

class UserController extends Controller {
    public function login(Request $request) {
        $email = $request->header('Email');
        $password = $request->header('Password');
        if (isset($email,$password)) {
            $user = User::where('Email', $email)->first();
            if ($user) {
                if ($user->Password == $password) {
                    if ($user->AccountActive == 1) {
                        return response([
                            'access_token' => $user->_token,
                            'message' => 'Login successful'
                        ], 200);
                    }
                    return response([
                        'message' => 'Account is not active'
                    ], 403);
                }
            }
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
        $token = $request->header('Token');

        $email = $request->header('Email');
        $phone = $request->header('Phone');
        $name = $request->header('Name');
        $surname = $request->header('Surname');
        if (isset($token, $email, $phone, $name, $surname)) {
            if (TokenChecker::getAdminID($token)) {
                if (RequestChecker::accountCreation($email, $phone, $name, $surname)) {
                    $google2fa = new Google2FA();
                    $newUser = new User;
                    $newUser->Email = $email;
                    $newUser->Phone = $phone;
                    $newUser->Name = $name;
                    $newUser->Surname = $surname;
                    $newUser->Password = $phone;
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
            return response([
                'message' => 'Bad token'
            ], 401);
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
        if (isset($token, $userId)) {
            if (TokenChecker::getAdminID($token)) {
                if (RequestChecker::emailValidation($email)) {
                    User::where("ID", $userId)->update(['Email'=>$email]);
                }
                if (RequestChecker::phoneValidation($phone)) {
                    User::where("ID", $userId)->update(['Phone'=>$phone]);
                }
                if (RequestChecker::nameValidation($name)) {
                    User::where("ID", $userId)->update(['Name'=>$name]);
                }
                if (RequestChecker::surnameValidation($surname)) {
                    User::where("ID", $userId)->update(['Surname'=>$surname]);
                }
                if (RequestChecker::accountActiveValidation($accountActive)) {
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
        return response([
            'message' => 'Bad request'
        ], 400);
    }
}
