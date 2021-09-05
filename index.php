<?php

require 'vendor/autoload.php';

use App\Controllers\MainController;

// Affichage de la vue princiaple
$controller = new MainController();

// Lorsque l'on soumet le formulaire
if (isset($_REQUEST['form_search']) && $_REQUEST['form_search']['search_submit'] == 'submitted') {
    // On assigne la data du formulaire
    $formData = $_REQUEST['form_search'];

    echo $controller->renderSearchResult($formData);
} else {
    // Affichage de la vue par défaut
    echo $controller->renderView();
}