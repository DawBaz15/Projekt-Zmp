<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ItemController extends Controller {
    public function create(Request $request) {
        $token = $request->input('Token');
        $name = $request->input('Name');
        if (!isset($token, $name)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }
        if (!RequestChecker::stringValidation($name)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::getAdminID($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        $newItem = new Item();
        $newItem->Name = $name;
        $newItem->save();
        return response([
            'message' => 'Item created'
        ], 200);
    }

    public function modify(Request $request) {
        $token = $request->input('Token');
        $id = $request->input('ID');
        $name = $request->input('Name');
        if (!isset($token, $id)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::getAdminID($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        if (!Item::where('ID', $id )->exists()) {
            return response([
                'message' => 'Item not found'
            ], 404);
        }

        if (isset($name) && RequestChecker::stringValidation($name)) {
            Item::where("ID", $id)->update(['Name'=>$name]);
        }
        return response([
            'message' => 'Item modified'
        ], 200);
    }

    public function index(Request $request) {
        $token = $request->input('Token');
        if (!isset($token)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::checkIfValid($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        return response([
            'message' => 'Array fetched',
            'array' => Item::all()
        ], 200);
    }
}
