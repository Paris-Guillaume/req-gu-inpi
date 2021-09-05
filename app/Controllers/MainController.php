<?php

namespace App\Controllers;

use App\Services\ApiService;

class MainController extends BaseContoller {
    private $apiService;

    public function __construct()
    {
        parent::__construct();
        $this->apiService = new ApiService();
    }

    public function renderView() {
        return $this->twig->render('view.html.twig');
    }
}