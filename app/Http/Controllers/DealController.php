<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDealRequest;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function store(StoreDealRequest $request)
    {
        return [
            "message" => "Ok, you reached me",
            "sentData" => $request->validated(),
        ];
    }
}
