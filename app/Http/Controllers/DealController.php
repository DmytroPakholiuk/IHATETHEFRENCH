<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealController extends Controller
{
    public function store(Request $request)
    {
        return [
            "message" => "Ok, you reached me",
            "sentData" => $request->input()
        ];
    }
}
