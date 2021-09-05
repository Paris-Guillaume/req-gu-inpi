<?php

namespace App\Services;

class ApiService
{
    private $curlService;
    // Url de base de l'api
    private $baseUrl = 'https://guichet-unique-demo.inpi.fr/api/';
    // JWT (JSON Web Token)
    private $jwt;

    public function __construct()
    {
        $this->curlService = new CurlService();
        $this->jwt = $this->apiConnect();
        // TODO : Crade ! mais pour l'instant ca permet de passer correctement le token
        $this->curlService = new CurlService($this->jwt);
    }


    /**
     * Fonction permettant la connexion à l'api du guichet unique
     * @return mixed
     */
    private function apiConnect()
    {
        $url = $this->baseUrl . 'user/login/sso';
        //TODO : Passer avec des fichiers de conf ou YAML pour les informations de connexion
        $data = [
            'username' => 'guillaume.paris@lextenso.fr',
            'password' => '20centMyTT95@',
        ];

        $response =  $this->curlService->makeCall($url, json_encode($data));

        try {
            if (!isset($response->token)) {
                Throw new \Exception("Problème lors de la connexion à l'api");
            }
        } catch (\Exception $exception) {
            echo '<pre>';
                echo $exception->getMessage();
            echo '</pre>';
        }

        return $response->token;
    }

    public function getFormalities()
    {
        $url = $this->baseUrl . 'formalities';
        return  $this->curlService->makeCall($url);
    }
}