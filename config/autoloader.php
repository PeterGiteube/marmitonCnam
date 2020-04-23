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
require_once __DIR__ . '/../framework/UserRoleInterface.php';
require_once __DIR__ . '/../framework/RoleChecker.php';

// Controllers
require_once __DIR__ . '/../controller/ConnexionController.php';
require_once __DIR__ . '/../controller/HomeController.php';
require_once __DIR__ . '/../controller/ProfileController.php';
require_once __DIR__ . '/../controller/RegistrationController.php';
require_once __DIR__ . '/../controller/AdminController.php';
require_once __DIR__ . '/../controller/WaitingRecipeController.php';
require_once __DIR__ . '/../controller/ValidateRecipeController.php';
require_once __DIR__ . '/../controller/ManageUserController.php';

// DAO
require_once __DIR__ . '/../dao/UserDao.php';

// Models
require_once __DIR__ . '/../model/User.php';

?>