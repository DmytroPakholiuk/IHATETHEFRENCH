<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDealRequest;
use App\Models\ZohoOauthToken;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function store(StoreDealRequest $request)
    {
        $token = ZohoOauthToken::orderBy("created_at", "desc")->first();
        $requestData = $request->validated();

        $base_url = env("BASE_API_URL");
        $client = new Client;
        $response = $client->post($base_url . "Deals", [
            RequestOptions::JSON => [
                "data" => [
                    [
                        "Deal_Name" => $requestData["name"],
                        "Account_Name" => $requestData["account_name"],
                        "Stage" => $requestData["stage"],
                        "Closing_Date" => $requestData["closing_date"]
                    ]
                ]
            ],
            "headers" => [
                "Authorization" => "Zoho-oauthtoken " . $token->access_token
            ]
        ]);

        $receivedData = Json::decode($response->getBody()->getContents());
        $data = $receivedData["data"][0];

        return [
            "code" => $data["code"],
            "message" => $data["message"],
            "sentData" => $request->validated()
        ];
    }
}
