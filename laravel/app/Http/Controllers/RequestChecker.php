<?php

namespace App\Http\Controllers;

use function PHPUnit\Framework\isEmpty;

class RequestChecker {
    public static function accountCreation(string $email, string $phone, string $name, string $surname) {
        if (self::emailValidation($email)) {
            if (self::phoneValidation($phone)) {
                if (self::stringValidation($name)) {
                    if (self::stringValidation($surname)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function emailValidation(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public static function phoneValidation(string $phone) {
        return strlen(preg_replace('/[^0-9]/', '', $phone)) == 9;
    }
    public static function stringValidation(string $string) {
        return strlen($string) > 0;
    }
    public static function accountActiveValidation(int $accountActive) {
        return ($accountActive == 0 || $accountActive == 1);
    }
}
