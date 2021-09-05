<?php

namespace App\Services;

class SearchService
{
    private $request;
    private $curlService;

    public function __construct()
    {
        $this->curlService = new CurlService();
    }

    /**
     * @param string $search
     * @return string
     */
    public function defineTypeOfSearch($search) {
        $typeOfSearch = '';

        if (is_numeric($search)) {
            // Si la chaine contient 9 nombre alors c'est un siret
            if (preg_match('/^\d{9}$/', strval($search)) == 1) {
                $typeOfSearch = 'siren';
                $this->request = 'siren/' . $search;
            } else if (preg_match('/^\d{14}$/', $search) == 1) {
                $typeOfSearch = 'siret';
                $this->request = 'siret/' . $search;
            }
        } else if (strlen($search) > 0 ) {
            $typeOfSearch = 'denominationUniteLegale';
            // Utilisation de rawurlencode pour ramplace les caractère spéciaux et les espace par leur valeur en %
            $this->request = 'siren?q=periode(' . rawurlencode('denominationUniteLegale:' . $search ) .')';
        }

        return $typeOfSearch;
    }

    public function searchCompanie($search) {
        // on récupère le type de recherche
        $url = 'https://api.insee.fr/entreprises/sirene/V3/' . $this->request;

        return $this->curlService->makeCall($url);
    }
}
