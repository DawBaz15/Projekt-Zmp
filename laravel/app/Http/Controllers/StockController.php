<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class StockController extends Controller {
    public function add(Request $request) {
        return response([
            'message' => 'Stock add'
        ], 200);
    }
    public function locate() {
        return response([
            'message' => 'Stock locate'
        ], 200);
    }
    public function index() {
        return response([
            'message' => 'Stock index'
        ], 200);
    }
    public function modify(Request $request) {
        return response([
            'message' => 'Stock modify'
        ], 200);
    }
}
