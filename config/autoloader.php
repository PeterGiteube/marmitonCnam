<?php 


// Framework components
require_once __DIR__ . '/../framework/Configuration.php';
require_once __DIR__ . '/../framework/routing/RoutesBuilder.php';
require_once __DIR__ . '/../framework/routing/Route.php';
require_once __DIR__ . '/../framework/redirection/RedirectTrait.php';
require_once __DIR__ . '/../framework/Router.php';
require_once __DIR__ . '/../framework/View.php';
require_once __DIR__ . '/../framework/Dao.php';
require_once __DIR__ . '/../framework/Controller.php';

// Controllers
require_once __DIR__ . '/../controller/ConnexionController.php';
require_once __DIR__ . '/../controller/HomeController.php';
require_once __DIR__ . '/../controller/ProfileController.php';

// DAO
require_once __DIR__ . '/../dao/UserDao.php';

// Models
require_once __DIR__ . '/../model/User.php';

?>