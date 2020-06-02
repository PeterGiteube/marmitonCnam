<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;

class IngredientController extends Controller {
    
    private $ingredientDao;
    private $ingredientCategoryDao;
    private $ingredientAllergenDao;
    private $location;

    public function __construct() {
        $this->ingredientDao = new IngredientDao();
        $this->ingredientCategoryDao = new IngredientCategoryDao();
        $this->ingredientAllergenDao = new IngredientAllergenDao();
        $this->location = Configuration::get("index") ."/admin/ingredients/manage";
    }

    public function list(Request $request) {    
        $ingredients = $this->ingredientDao->getIngredients();

        $result = array_map(function($ingredient) {
            return $ingredient->getName();
        }, $ingredients);
        
        return Response::json($result);       
    }

    public function add(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $post = $request->request();
        $ingredientCategories = [];

        if($post->count() > 0) {
            $nameIngredient = $post->get('ingredient');
            $ingredientCategory = $post->get('ingredient-category');

            if(strlen($nameIngredient) > 0
            && strlen($ingredientCategory) > 0){

                $idIngredientCategory = intval($this->ingredientCategoryDao->getIdIngredientCategoryByName($ingredientCategory));

                try {
                    $this->ingredientDao->insertIngredient($nameIngredient, $idIngredientCategory);
                }
                catch(Exception $ex) {
                
                }
            }
        }

        $ingredientCategories = $this->ingredientCategoryDao->getIngredientCategories();

        return Response::view("addIngredients", ["ingredientCategories" => $ingredientCategories]);    
    }

    public function edit(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));  

        $ingredientCategories = [];

        if(is_int($id)) {
            $ingredient = $this->ingredientDao->getIngredientById($id);
            $ingredientCategory = $this->ingredientCategoryDao->getIdIngredientCategoryById($ingredient->getIdIngredientCategory());
            $ingredientCategories = $this->ingredientCategoryDao->getIngredientCategories();

            return Response::view("editIngredient", ["ingredient" => $ingredient, "ingredientCategory" => $ingredientCategory, "ingredientCategories" => $ingredientCategories]);
        }
    }

    public function update(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $post = $request->request();

        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));  

        if ($post->count() > 0) {
            $ingredientName = $post->get('ingredient');
            $ingredientCategory = $post->get('ingredient-category');
            $idIngredientCategory = intval($this->ingredientCategoryDao->getIdIngredientCategoryByName($ingredientCategory));
            
            if (strlen($ingredientName) > 0 
            && strlen($ingredientCategory) > 0) { 
    
                try {
                    $this->ingredientDao->updateIngredientById($id, $ingredientName, $idIngredientCategory);
                    $this->redirect($this->location); 
                }
                catch(Exception $ex) {
                    $this->setInsertError($ex->getMessage());
                }
            } else {
                $this->setInsertError("Les champs ne peuvent pas être vides"); 
            }
           $this->redirect(Configuration::get('index') . '/admin/ingredient/' . $id . "/edit");
        }
    }

    public function delete(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $post = $request->request();
        $id = intval($post->get('id'));

        try {
            $this->ingredientAllergenDao->deleteIngredientAllergenByIngredientId($id);
            $this->ingredientDao->deleteIngredientById($id);           
        } catch(Exception $ex) {
            return Response::json(["success" => false]);
        }

        return Response::json(["success" => true]);
    }

    private function setInsertError(string $message)
    {
        $this->error = $message;
    }
}