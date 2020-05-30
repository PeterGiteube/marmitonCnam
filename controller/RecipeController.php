<?php

use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;
use Framework\Configuration;

class RecipeController extends Controller {

    private $recipeDao;
    private $recipeCategoryDao;
    private $ingredientDao;
    private $unitDao;
    private $recipeIngredientDao;
    private $stepDao;
    private $location;

    public function __construct() {
        $this->recipeDao = new RecipeDao();
        $this->recipeCategoryDao = new RecipeCategoryDao();
        $this->ingredientDao = new IngredientDao();
        $this->unitDao = new UnitDao();
        $this->recipeIngredientDao = new RecipeIngredientDao();
        $this->stepDao = new StepDao();

        $this->location = Configuration::get("index") ."/admin/recipes/validate";
    }

    public function validate() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $validRecipes = $this->recipeDao->getValidRecipes();
        $result = array_map($this->formatHTMLRecipe(), $validRecipes);

        return Response::view("validateRecipe", ["recipes" => $result]);
    }

    public function waiting() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $waitingRecipes = $this->recipeDao->getWaitingRecipes();
        $result = array_map($this->formatHTMLRecipe(), $waitingRecipes);

        return Response::view("waitingRecipe", ["recipes" => $result]);
    }

    private function formatHTMLRecipe() {
        return function($recipe) {
            return "<tr id='recipeRow" . $recipe->getId() . "'>
                <td>".$recipe->getId()."</td>
                <td>".$recipe->getName()."</td>
                <td>".$recipe->getCost()."</td>
                <td>".$recipe->getPrepTime()."</td>
                <td>".$recipe->getCookingTime()."</td>
                <td>".$recipe->getReleaseDate()."</td>
                <td>".$recipe->getHeadCount()."</td>
                <td><a class='btn btn-secondary' href='".Configuration::get('index')."/admin/recipe/".$recipe->getId()."/edit' role='button'>Edit</a> <button data-id='".$recipe->getId()."'id='delete-recipe' class='btn btn-danger' type='button' data-toggle='modal' data-target='#delete-recipe-modal'>Supprimer</button></td>
            </tr>";
        };
    }

    public function add(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categories = [];
        
        $post = $request->request();
        $userId = $_SESSION['user']->getId();
        
        
        if($post->count() > 0) {
            // TODO : return redirection vers une page
            $name = $post->get('name');
            $cost = $post->get('cost');
            $prepTime = $post->get('prep_time');
            $cookingTime = $post->get('cooking_time');
            $headcount = $post->get('head_count');
            $recipeCategory = $post->get('recipe_category');
            $listIngredient = $post->get('ingredient');
            $listQuantity = $post->get('quantity');
            $listUnit = $post->get('unit');
            $listStep = $post->get('step');
        
            if(strlen($name) > 0
            && strlen($cost) > 0
            && strlen($prepTime) > 0
            && strlen($cookingTime) > 0
            && strlen($headcount) > 0
            && strlen($recipeCategory) > 0
            && is_array($listIngredient)
            && is_array($listQuantity)
            && is_array($listUnit)
            && is_array($listStep)) {

                $releaseDate = date("Y-m-d");
                try {
                    $mapRecipeCategory = $this->recipeCategoryDao->getRecipeCategoryByName($recipeCategory);
                    $IdRecipeCategory = $mapRecipeCategory->getIdCategory();
                    $this->recipeDao->insertRecipe($name, $cost, $prepTime, $cookingTime, $releaseDate, 1, $headcount, intval($userId), intval($IdRecipeCategory));
                    $recipeId = $this->recipeDao->getLastRecipeInsertedId();

                    for($i = 0; $i < count($listIngredient); $i++) {
                        $ingredientId = $this->ingredientDao->getIngredientIdByName($listIngredient[$i]);
                        $unitId = $this->unitDao->getUnitByLabel($listUnit[$i]);
                        $this->recipeIngredientDao->insertIngredientByRecipeId(intval($recipeId),intval($ingredientId),intval($listQuantity[$i]),intval($unitId));
                    }

                    for($i = 0; $i < count($listStep); $i++) {
                        $numberStep = $i + 1;
                        $this->stepDao->insertStep($numberStep, $listStep[$i], $recipeId);
                    }
                } 
                catch(Exception $ex) {
                    // TODO : do something here when error
                }
            }
        }

        $categories = $this->recipeCategoryDao->getRecipeCategories();
        $ingredients = $this->ingredientDao->getIngredients();
        $units = $this->unitDao->getUnits();

        return Response::view("addRecipe", ["categories" => $categories, "ingredients" => $ingredients, "units" => $units]);
    }

    public function delete(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $post = $request->request();
        $id = intval($post->get('id'));
        
        $this->stepDao->deleteStepByRecipeId($id);
        $this->recipeIngredientDao->deleteIngredientFromRecetteId($id);
        $this->recipeDao->deleteRecipeById($id);

        return Response::json(["success" => true]);          
    }

    public function edit(Request $request) { 
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));  

        if(is_int($id)) {
            $recipe = $this->recipeDao->getRecipeById($id);
            $recipeIngredient = $this->recipeIngredientDao->getIngredientByIdRecipe($id);
            $recipeStep = $this->stepDao->getStepByRecipeId($id);

            $categories = $this->recipeCategoryDao->getRecipeCategories();
            $ingredients = $this->ingredientDao->getIngredients();
            $units = $this->unitDao->getUnits();


            return Response::view("editRecipe",['recipe' => $recipe, "recipeIngredients" => $recipeIngredient, "recipeSteps" => $recipeStep, "categories" => $categories, "ingredients" => $ingredients, "units" => $units]);
        } 

        return Response::view("404");
    }

    public function update(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categories = [];
        
        $post = $request->request();
        $userId = $_SESSION['user']->getId();

        $arguments = $request->routeArguments();
        $recipeId = intval($arguments->get('id')); 
        
        
        if($post->count() > 0) {
            // TODO : return redirection vers une page
            $name = $post->get('name');
            $cost = $post->get('cost');
            $prepTime = $post->get('prep_time');
            $cookingTime = $post->get('cooking_time');
            $headcount = $post->get('head_count');
            $recipeCategory = $post->get('recipe_category');
            $listIngredient = $post->get('ingredient');
            $listQuantity = $post->get('quantity');
            $listUnit = $post->get('unit');
            $listStep = $post->get('step');
        
            if(strlen($name) > 0
            && strlen($cost) > 0
            && strlen($prepTime) > 0
            && strlen($cookingTime) > 0
            && strlen($headcount) > 0
            && strlen($recipeCategory) > 0
            && is_array($listIngredient)
            && is_array($listQuantity)
            && is_array($listUnit)
            && is_array($listStep)) {

                $releaseDate = date("Y-m-d");
                try {
                    $mapRecipeCategory = $this->recipeCategoryDao->getRecipeCategoryByName($recipeCategory);
                    $IdRecipeCategory = $mapRecipeCategory->getIdCategory();
                    $this->recipeDao->updateRecipeById($recipeId, $name, $cost, $prepTime, $cookingTime, $releaseDate, 1, $headcount, intval($IdRecipeCategory));
                
                    for($i = 0; $i < count($listIngredient); $i++) {
                        $ingredientId = $this->ingredientDao->getIngredientIdByName($listIngredient[$i]);
                        $unitId = $this->unitDao->getUnitByLabel($listUnit[$i]);
                        $this->recipeIngredientDao->updateIngredientByRecipeIngredientId(intval($ingredientId), intval($listQuantity[$i]), intval($unitId), intval($recipeId));
                    }

      
                    for($i = 0; $i < count($listStep); $i++) {
                        $numberStep = $i + 1;

                        
                        $this->stepDao->updateStepByRecipeId($recipeId, $numberStep, $listStep[$i]);
                    }
                    $this->redirect($this->location);
                } 
                catch(Exception $ex) {
                    $this->setUpdateError($ex->getMessage());      
                    // TODO : do something here when error
                }
            } else {
                $this->setUpdateError("Les champs ne peuvent pas être vides");
            }
            $this->redirect(Configuration::get('index') . '/admin/recipe/' . $recipeId . "/edit");
        }
    }

    private function setUpdateError(string $message)
    {
        $this->error = $message;
    }
}