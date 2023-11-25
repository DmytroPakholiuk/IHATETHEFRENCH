<?php

namespace App\Console\Commands;

use App\Models\ZohoOauthToken;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class StartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-command {code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $code = $this->argument("code");
        echo $code . "\n";

        $baseOauthUrl = env("BASE_OAUTH_URL");
        $guzzle = new Client();
        $response = $guzzle->post(
            $baseOauthUrl . "oauth/v2/token",
            [
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "client_id" => env("ZOHO_CLIENT_ID"),
                    "client_secret" => env("ZOHO_CLIENT_SECRET"),
                    "redirect_uri" => null,
                    "code" => $code
                ]
            ]
        );

//        var_dump($response);

        $receivedData = Json::decode($response->getBody()->getContents());

//        var_dump($receivedData);

        if (isset($receivedData["error"]) && $receivedData["error"] == "invalid_code") {
            echo "---the code you entered was rejected by Zoho. Maybe it expired?---\n";
            die();
        }

        $token = new ZohoOauthToken();

        $token->access_token = $receivedData["access_token"];
        $token->refresh_token = $receivedData["refresh_token"];
        $token->expires_at = Carbon::now()->addHour();
        $token->token_type = $receivedData["token_type"];
        $token->api_domain = $receivedData["api_domain"];
        $token->save();

//        var_dump($token);

        echo "Starting automatic access token replacement";
        Artisan::call("schedule:work");
    }
}
