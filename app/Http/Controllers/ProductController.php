<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Word::all();

        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }
}
