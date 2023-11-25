<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(StoreAccountRequest $request)
    {
        return [
            "message" => "Ok, you reached me",
            "sentData" => $request->validated()
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
