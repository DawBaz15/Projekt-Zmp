<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class StockController extends Controller {
    public function add(Request $request) {
        $token = $request->header('Token');
        $id = $request->header('ProductID');
        $amount = $request->header('Amount');
        $location = $request->header('Location');
        if (!isset($token,$id,$amount,$location)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::getUserID($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        if (!Item::where('ID', $id )->exists()) {
            return response([
                'message' => 'Item not found'
            ], 404);
        }

        $newStock = new Stock();
        $newStock->ProductID = $id;
        $newStock->Amount = $amount;
        $newStock->Location = $location;
        $newStock->Date = date('Y/m/d', time());
        $newStock->save();
        return response([
            'message' => 'Stock added'
        ], 200);
    }

    public function locate(Request $request) {
        $token = $request->header('Token');
        $id = $request->header('ProductID');
        if (!isset($token,$id)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::getUserID($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        return response([
            'message' => 'Stock located',
            'array' => Stock::where('ProductID', $id)->where('IsActive', 1)->get(['Amount','Location']),
        ], 200);
    }

    public function index(Request $request) {
        $token = $request->header('Token');
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
            'array' => Stock::all()
        ], 200);
    }

    public function modify(Request $request) {
        $token = $request->header('Token');
        $id = $request->header('ID');
        $productId = $request->header('ProductID');
        $amount = $request->header('Amount');
        $location = $request->header('Location');
        if (!isset($token,$id)) {
            return response([
                'message' => 'Bad request'
            ], 400);
        }

        if (!TokenChecker::checkIfValid($token)) {
            return response([
                'message' => 'Bad token'
            ], 401);
        }

        if (!Stock::where('ID', $id )->exists()) {
            return response([
                'message' => 'Stock not found'
            ], 404);
        }

        if (isset($productId) && Item::where('ID', $productId )->exists()) {
            Stock::where("ID", $id)->update(['ProductID'=>$productId]);
        }
        if (isset($amount)) {
            Stock::where("ID", $id)->update(['Amount'=>$amount]);
        }
        if (isset($location)) {
            Stock::where("ID", $id)->update(['Location'=>$location]);
        }
        return response([
            'message' => 'Stock modified'
        ], 200);
    }
}
