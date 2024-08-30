<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        return response()->json(['success' => true]);
    }
}
