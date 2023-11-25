<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\ZohoOauthToken;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(StoreAccountRequest $request)
    {
        $token = ZohoOauthToken::orderBy("created_at", "desc")->first();
        $requestData = $request->validated();

        $base_url = env("BASE_API_URL");
        $client = new Client;
        $response = $client->post($base_url . "Accounts", [
            RequestOptions::JSON => [
                "data" => [
                    [
                        "Account_Name" => $requestData["name"],
                        "Website" => $requestData["website"],
                        "Phone" => $requestData["phone"]
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

    public function index(Request $request)
    {
        $token = ZohoOauthToken::orderBy("created_at", "desc")->first();

        $base_url = env("BASE_API_URL");
        $client = new Client;
        $response = $client->get($base_url . "Accounts?fields=Account_Name", [
            "headers" => [
                "Authorization" => "Zoho-oauthtoken " . $token->access_token
            ]
        ]);

        $receivedData = Json::decode($response->getBody()->getContents());

        $names = [];
        foreach ($receivedData["data"] as $datum){
            $names[] = $datum["Account_Name"];
        }

        return [
            "data" => $names,
//            "message" => "Ok, you reached me",
//            "sentData" => $request->input()
        ];
    }
}
