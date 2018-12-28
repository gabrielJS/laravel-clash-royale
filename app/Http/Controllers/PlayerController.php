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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjBiM2Q1NzQ3LTMyOTUtNDY1Ny1iNWM1LTBlMTJkNTc0NzAxZSIsImlhdCI6MTU0NTgzODY1Nywic3ViIjoiZGV2ZWxvcGVyL2JjYTBjYzQ4LWQwZGUtZGFiZS05NzFlLTMzMmJhZjViYzA5NCIsInNjb3BlcyI6WyJyb3lhbGUiXSwibGltaXRzIjpbeyJ0aWVyIjoiZGV2ZWxvcGVyL3NpbHZlciIsInR5cGUiOiJ0aHJvdHRsaW5nIn0seyJjaWRycyI6WyIxOTAuMjA4LjU3LjIyNSIsIjMxLjIyMC4wLjIyNSJdLCJ0eXBlIjoiY2xpZW50In1dfQ.LoKOT-pMQlEQ463Q_pStESvyB_DHv_SC6irIiNk8ZW9vsoJJ2QVgby08XegnY5Fa-xrQWbjaxymMplbNiSHu3A';
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
