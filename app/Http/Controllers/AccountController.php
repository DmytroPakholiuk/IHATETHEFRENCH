<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        return [
            "message" => "Ok, you reached me",
            "sentData" => $request->input()
        ];
    }
}
