<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class BaseContoller
 * @package App\Controller
 * Controller de base avec les éléments par défaut nécessaire au fonctionnement d'un controller
 */
Abstract class BaseContoller {
    protected $twig;

    public function __construct()
    {
        // Configration de twig
        $loader = new FilesystemLoader('app/Templates/');
        $this->twig = new Environment($loader);
    }
}