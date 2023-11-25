<?php

namespace App\Console\Commands;

use App\Models\ZohoOauthToken;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Carbon;

class RefreshTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-token-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Access token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "Refreshing token...";

        $oldToken = ZohoOauthToken::orderBy("created_at", "desc")->first();
//        var_dump($oldToken);

        $baseOauthUrl = env("BASE_OAUTH_URL");
        $guzzle = new Client();
        $response = $guzzle->post(
            $baseOauthUrl . "oauth/v2/token",
            [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "client_id" => env("ZOHO_CLIENT_ID"),
                    "client_secret" => env("ZOHO_CLIENT_SECRET"),
                    "refresh_token" => $oldToken->refresh_token
                ]
            ]
        );

        $receivedData = Json::decode($response->getBody()->getContents());

        var_dump($receivedData);

        $token = new ZohoOauthToken();

        $token->access_token = $receivedData["access_token"];
        $token->refresh_token = $oldToken->refresh_token;
        $token->expires_at = Carbon::now()->addHour();
        $token->token_type = $receivedData["token_type"];
        $token->api_domain = $receivedData["api_domain"];
        $token->save();
    }

}
