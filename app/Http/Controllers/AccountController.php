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

    public function index(Request $request)
    {
        return [
            "data" => [
                "Account 1",
                "Account 4",
                "Account fuck",
                "Account penis",
            ],
            "message" => "Ok, you reached me",
            "sentData" => $request->input()
        ];
    }
}
