<?php
namespace Moja;

use Exception;
use Illuminate\Support\Facades\Log;

class Moja implements MojaInterface {

    protected $username;
    protected $password;
    protected $token;
    protected $webHook;

    public  function __construct() 
    {
        $this->username = env('MOJA_USERNAME');
        $this->password = env('MOJA_PASSWORD');
        $this->webHook = env('MOJA_WEBHOOK');
    }

    public function getToken() 
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://api.mojasms.dev/login',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'email' => $this->username,
                        'password' => $this->password,
                    ],
                ]
            );
            $body = $response->getBody();
            $data = json_decode((string) $body, true);

            $this->token =$data['data']['token'];

            return $this;
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            echo $ex->getMessage();
        }
    }

    public function getBalance() 
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get(
                'https://api.mojasms.dev/balance',
                [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->token,
                        'Accept' => 'application/json',
                    ],
                ]
            );
            $body = $response->getBody();
            dd(json_decode((string) $body, true));
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            echo $ex->getMessage();
        }
    }
    public function sendSMS($sms = null, $phone=null)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->post(
                'https://api.mojasms.dev/sendsms',
                [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->token,
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'from' => 'MOJAGATE',
                        'phone' => $phone ?? '254751148166',
                        'message' => $sms ?? 'Welcome to MojaGate',
                        'message_id' => time(),
                        'webhook_url' => $this->webHook,
                    ],
                ]
            );

            $body = $response->getBody();

            return json_decode((string) $body, true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            echo $ex->getMessage();
        }
    }

    public function sendBulkSMS($smses)
    {
        $client = new \GuzzleHttp\Client();

        // [
        //     'from' => 'MOJAGATE',
        //     'phone' => $phone ?? '254751148166',
        //     'message' => $sms ?? 'Welcome to MojaGate',
        //     'message_id' => 'e1k5c2e9-99ba-4d6d',
        //     'webhook_url' => 'https://mojagate.com/sms-webhook',
        // ]

        $response = $client->post(
            'https://api.mojasms.dev/sendsms',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token,
                    'Accept' => 'application/json',
                ],
                'json' => $smses,
            ]
        );

        $body = $response->getBody();
        dd(json_decode((string) $body, true));
    }
}