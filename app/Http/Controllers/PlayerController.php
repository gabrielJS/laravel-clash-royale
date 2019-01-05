<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class PlayerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idReemplazado = str_replace('#','%23', $id);
        $token = 'your token here';
        $client = new Client(['base_uri' => 'https://api.clashroyale.com/v1/']);

        try {
            $res = $client->get("players/$idReemplazado", [
                'headers' => [
                    'authorization' => "Bearer {$token}",
                    'Accept' => 'application/json'
                ]
            ],
                ['exceptions' => false]
            );
        } catch (Exception\BadResponseException $e) {
            $res = $e->getResponse();
            $responseBodyAsString = $res->getBody()->getContents();
            return $responseBodyAsString;
        }

        return $res->getBody()->getContents();
    }
}
