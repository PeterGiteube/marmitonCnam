<?php 


// framework components
require_once __DIR__ . '/../framework/Configuration.php';
require_once __DIR__ . '/../framework/routing/RoutesBuilder.php';
require_once __DIR__ . '/../framework/routing/Route.php';
require_once __DIR__ . '/../framework/redirection/RedirectTrait.php';
require_once __DIR__ . '/../framework/Router.php';
require_once __DIR__ . '/../framework/Model.php';
require_once __DIR__ . '/../framework/View.php';

// controllers
require_once __DIR__ . '/../controller/ConnexionController.php';
require_once __DIR__ . '/../controller/HomeController.php';

// models
require_once __DIR__ . '/../model/Utilisateur.php';
require_once __DIR__ . '/../model/Ingredient.php';
require_once __DIR__ . '/../model/Recette.php';
require_once __DIR__ . '/../model/Commentaire.php';

?>