<?php

namespace App\Http\Controllers;

use App\Models\ZohoToken;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


class ZohoApi extends Controller
{

    private function getZohoAccessToken()
    {
        $token = ZohoToken::latest()->first();

        // Check if token is expired or not available
        if (!$token || Carbon::now()->greaterThanOrEqualTo($token->expires_at)) {
            return $this->renewZohoAccessToken();
        }

        return $token->access_token;
    }

    private function renewZohoAccessToken()
    {
        $client_id = env('ZOHO_CLIENT_ID');
        $client_secret = env('ZOHO_CLIENT_SECRET');

        $client = new Client();

        $response = $client->post('https://accounts.zoho.com/oauth/v2/token', [
            'form_params' => [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'scope' => 'ZohoCreator.report.READ',
                'grant_type' => 'client_credentials',
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Calculate expiration time (1 hour from now)
        $expires_at = Carbon::now()->addHour();

        // Store the new token in the database
        $token = ZohoToken::create([
            'access_token' => $responseBody['access_token'],
            'expires_at' => $expires_at,
        ]);

        return $token->access_token;
    }

    public function zohoApiData()
    {
        $access_token = $this->getZohoAccessToken();

        $client = new Client();

        $response = $client->get('https://creator.zoho.com/api/v2.1/tie_dev/chapters/report/Member_Details_Admin_View', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return response()->json($responseBody);
    }

    //from this response body we can get the data from zoho api
    public function searchByMembershipId($membershipId)
    {
        $access_token = $this->getZohoAccessToken();
        //Log::info('Access Token: ' . $access_token);

        $client = new Client();

        $url = 'https://creator.zoho.com/api/v2.1/tie_dev/chapters/report/Member_Details_Admin_View?Membership_ID=' . $membershipId;
        $response = $client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);
        //from response return ID , Chapter_Name, "Name1": { "first_name": "testk33" }, Phone_Number
        Log::info('Response Body: ' . json_encode($responseBody));

       // return $responseBody['data'][0]['ID'];

       return ($responseBody);
    }

}
