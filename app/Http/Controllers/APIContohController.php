<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIContohController extends Controller
{
    public function index(){
        return response()->json("hello world!");
    }
}
