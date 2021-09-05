<?php

namespace App\Services;

class CurlService
{
    private $headers;

    public function __construct($jwt = null)
    {
        $this->headers = [
            'Accept: application/ld+json',
            'Content-Type: application/ld+json'
        ];

        if (isset($jwt)) {
            array_push($this->headers, 'Authorization: Bearer ' . $jwt);
        }
    }

    public function makeCall($url, $data = null)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Si on envoi des data alors on est en mode POST
        if ($data) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        return $result;
    }
}