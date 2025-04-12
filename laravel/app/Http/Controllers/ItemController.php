<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ItemController extends Controller {
    public function create(Request $request) {
        return response([
            'message' => 'Item create'
        ], 200);
    }
    public function modify(Request $request) {
        return response([
            'message' => 'Item modify'
        ], 200);
    }
    public function index() {
        return response([
            'message' => 'Item index'
        ], 200);
    }
}
