<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\View;

class UserController extends Controller
{

    private $userDao;
    private $recipeDao;
    private $location;
    private $error;
    private $recipeFormater;

    public function __construct()
    {
        $this->userDao = new UserDao();
        $this->recipeDao = new RecipeDao();
        $this->recipeFormater = new RecipeFormater();

        $this->location = Configuration::get("index") ."/admin/users/manage";
        $this->error = "";
    }


    public function delete(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $post = $request->request();
        $id = $post->get('id');

        if ($this->userDao->deleteUserById($id)) {
            return Response::json(["success" => true]);
        } 

        return Response::json(["success" => false]);
    }

    public function add(Request $request)
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $post = $request->request();

        if ($post->count() > 0) {
            $pseudo = $post->get('pseudo');
            $password = $post->get('password');
            $lastName = $post->get('last-name');
            $firstName = $post->get('first-name');
            $mail = $post->get('mail');
            $phoneNumber = $post->get('phone-number');
            $city = $post->get('city');
            $role = $post->get('role');

            if (strlen($pseudo) > 0 
            && strlen($password) > 0 
            && strlen($lastName) > 0 
            && strlen($firstName) > 0 
            && strlen($mail) > 0 
            && strlen($phoneNumber) > 0 
            && strlen($city) > 0 
            && strlen($role) > 0) { 
               
                try {
                    $this->userDao->insertUser($pseudo, $password, $lastName, $firstName, $mail, $phoneNumber, $city, $role);
                    $this->redirect($this->location);
                }
                catch(Exception $ex) {
                    $this->setInsertError($ex->getMessage());
                }

            } else {
                $this->setInsertError("Les champs ne peuvent pas être vides"); 
            }
        }

        return Response::view("addUser", ["error" => $this->error]);
    }

    
    public function edit(Request $request) { 
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));  

        if(is_int($id)) {
            $user = $this->userDao->getUserById($id);
            return Response::view("editUser",['user' => $user]);
        } 

        return Response::view("404");
    }

    // TODO : refactor this in edit controller directy
    public function update(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $post = $request->request();

        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));  

        if ($post->count() > 0) {
            $pseudo = $post->get('pseudo');
            $lastName = $post->get('last-name');
            $firstName = $post->get('first-name');
            $mail = $post->get('mail');
            $phoneNumber = $post->get('phone-number');
            $city = $post->get('city');
            $role = $post->get('role');
            
            if (strlen($pseudo) > 0 
            && strlen($lastName) > 0 
            && strlen($firstName) > 0 
            && strlen($mail) > 0 
            && strlen($phoneNumber) > 0 
            && strlen($city) > 0 
            && strlen($role) > 0) { 
    
                try {
                    $this->userDao->updateUserInfosById($id, $pseudo, $lastName, $firstName, $mail, $phoneNumber, $city, $role);
                    $this->redirect($this->location); 
                }
                catch(Exception $ex) {
                    $this->setInsertError($ex->getMessage());
                }
            } else {
                $this->setInsertError("Les champs ne peuvent pas être vides"); 
            }
           $this->redirect(Configuration::get('index') . '/admin/user/' . $id . "/edit");
        }
    }

    public function consultRecipesUser(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $arguments = $request->routeArguments();
        $id = $_SESSION['user']->getId(); 

        $recipes = $this->recipeDao->getRecipesByUserId($id);
        $resultRecipe = array_map($this->recipeFormater->formatHTMLRecipes(), $recipes);
        return Response::view("userRecipe",['recipes' => $resultRecipe]);
    }

    
    private function setInsertError(string $message)
    {
        $this->error = $message;
    }
}      
    