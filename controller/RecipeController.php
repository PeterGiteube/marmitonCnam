<?php

use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;
use Framework\Configuration;

class RecipeController extends Controller
{

    private $recipeDao;
    private $recipeCategoryDao;
    private $ingredientDao;
    private $unitDao;
    private $recipeIngredientDao;
    private $stepDao;
    private $location;

    public function __construct()
    {
        $this->recipeDao = new RecipeDao();
        $this->recipeCategoryDao = new RecipeCategoryDao();
        $this->ingredientDao = new IngredientDao();
        $this->unitDao = new UnitDao();
        $this->recipeIngredientDao = new RecipeIngredientDao();
        $this->stepDao = new StepDao();

        $this->location = Configuration::get("index") . "/admin/recipes/validate";
    }

    public function validate()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $validRecipes = $this->recipeDao->getValidRecipes();
        $result = array_map($this->formatHTMLRecipe(), $validRecipes);

        return Response::view("validateRecipe", ["recipes" => $result]);
    }

    public function waiting()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $waitingRecipes = $this->recipeDao->getWaitingRecipes();
        $result = array_map($this->formatHTMLRecipe(), $waitingRecipes);

        return Response::view("waitingRecipe", ["recipes" => $result]);
    }

    private function formatHTMLRecipe()
    {
        return function ($recipe) {
            return "<tr id='recipeRow" . $recipe->getId() . "'>
                <td>" . $recipe->getId() . "</td>
                <td>" . $recipe->getName() . "</td>
                <td>" . $recipe->getCost() . "</td>
                <td>" . $recipe->getPrepTime() . "</td>
                <td>" . $recipe->getCookingTime() . "</td>
                <td>" . $recipe->getReleaseDate() . "</td>
                <td>" . $recipe->getHeadCount() . "</td>
                <td><a class='btn btn-secondary' href='" . Configuration::get('index') . "/admin/recipe/" . $recipe->getId() . "/edit' role='button'>Edit</a> <button data-id='" . $recipe->getId() . "'id='delete-recipe' class='btn btn-danger' type='button' data-toggle='modal' data-target='#delete-recipe-modal'>Supprimer</button></td>
            </tr>";
        };
    }

    public function add(Request $request)
    {
        $categories = [];

        $post = $request->request();
        $userId = $_SESSION['user']->getId();

        if ($post->count() > 0) {
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
            $recipeImageName = $_FILES["recipe-image"]["name"];
            $recipeImageSize = $_FILES["recipe-image"]["size"];

            if (
                strlen($name) > 0
                && strlen($cost) > 0
                && strlen($prepTime) > 0
                && strlen($cookingTime) > 0
                && strlen($headcount) > 0
                && strlen($recipeCategory) > 0
                && is_array($listIngredient)
                && is_array($listQuantity)
                && is_array($listUnit)
                && is_array($listStep)
            ) {

                $releaseDate = date("Y-m-d");

                try {
                    $VALIDATE_RECIPE = 0;
                    if ($this->hasRole("ROLE_ADMIN")) {
                        $VALIDATE_RECIPE = 1;
                    }

                    $mapRecipeCategory = $this->recipeCategoryDao->getRecipeCategoryByName($recipeCategory);
                    $IdRecipeCategory = $mapRecipeCategory->getIdCategory();

                    $uploadedDate = date("d-m-Y_H-i-s");

                    $ext = explode('.', $recipeImageName);
                    $extensionFile = $ext[1];

                    $newFileName = $ext[0] . '_' . $uploadedDate;
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . 'marmitonCnam/public/recipe-images/' . $newFileName . '.' . $extensionFile;
                    
                    // Si la taille de l'image est au dessus de 4MB.
                    if ($recipeImageSize < 4194304) {
                        if (move_uploaded_file($_FILES['recipe-image']['tmp_name'], $targetPath)) {
                            $this->recipeDao->insertRecipe($name, $cost, $prepTime, $cookingTime, $releaseDate, $VALIDATE_RECIPE, $headcount, $newFileName . "." . $extensionFile, intval($userId), intval($IdRecipeCategory));
                            $recipeId = $this->recipeDao->getLastRecipeInsertedId();

                            for ($i = 0; $i < count($listIngredient); $i++) {
                                $ingredientId = $this->ingredientDao->getIngredientIdByName($listIngredient[$i]);
                                $unitId = $this->unitDao->getUnitByLabel($listUnit[$i]);
                                $this->recipeIngredientDao->insertIngredientByRecipeId(intval($recipeId), intval($ingredientId), intval($listQuantity[$i]), intval($unitId));
                            }

                            for ($i = 0; $i < count($listStep); $i++) {
                                $numberStep = $i + 1;
                                $this->stepDao->insertStep($numberStep, $listStep[$i], $recipeId);
                            }
                        }
                    }
                } catch (Exception $ex) {
                    $this->setUpdateError($ex->getMessage());
                }
            }
        }

        $categories = $this->recipeCategoryDao->getRecipeCategories();
        $ingredients = $this->ingredientDao->getIngredients();
        $units = $this->unitDao->getUnits();

        return Response::view("addRecipe", ["categories" => $categories, "ingredients" => $ingredients, "units" => $units]);
    }

    public function delete(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $post = $request->request();
        $id = intval($post->get('id'));

        $this->stepDao->deleteStepByRecipeId($id);
        $this->recipeIngredientDao->deleteRecipeIngredientByRecipeId($id);
        $this->recipeDao->deleteRecipeById($id);

        return Response::json(["success" => true]);
    }

    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));

        if (is_int($id)) {
            $recipe = $this->recipeDao->getRecipeById($id);
            $recipeIngredient = $this->recipeIngredientDao->getIngredientByIdRecipe($id);
            $recipeStep = $this->stepDao->getStepByRecipeId($id);

            $categories = $this->recipeCategoryDao->getRecipeCategories();
            $ingredients = $this->ingredientDao->getIngredients();
            $units = $this->unitDao->getUnits();


            return Response::view("editRecipe", ['recipe' => $recipe, "recipeIngredients" => $recipeIngredient, "recipeSteps" => $recipeStep, "categories" => $categories, "ingredients" => $ingredients, "units" => $units]);
        }

        return Response::view("404");
    }

    public function update(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categories = [];

        $post = $request->request();
        $userId = $_SESSION['user']->getId();

        $arguments = $request->routeArguments();
        $recipeId = intval($arguments->get('id'));


        if ($post->count() > 0) {
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

            // verifier que recipe-image existe
            $recipeImageName = $_FILES["recipe-image"]["name"];
            $recipeImageSize = $_FILES["recipe-image"]["size"];

            if (
                strlen($name) > 0
                && strlen($cost) > 0
                && strlen($prepTime) > 0
                && strlen($cookingTime) > 0
                && strlen($headcount) > 0
                && strlen($recipeCategory) > 0
                && is_array($listIngredient)
                && is_array($listQuantity)
                && is_array($listUnit)
                && is_array($listStep)
            ) {

                $releaseDate = date("Y-m-d");
                try {
                    $mapRecipeCategory = $this->recipeCategoryDao->getRecipeCategoryByName($recipeCategory);
                    $IdRecipeCategory = $mapRecipeCategory->getIdCategory();

                    // On vérifie si on a remplie l'input file
                    if (!empty($recipeImageName)) {
                        $uploadedDate = date("d-m-Y_H-i-s");

                        $ext = explode('.', $recipeImageName);
                        $extensionFile = $ext[1];

                        $newFileName = $ext[0] . '_' . $uploadedDate;
                        $targetPath = $_SERVER['DOCUMENT_ROOT'] . 'marmitonCnam/public/recipe-images/' . $newFileName . '.' . $extensionFile;

                        // Si la taille de l'image est au dessus de 4MB.
                        if ($recipeImageSize < 4194304) {
                            if (move_uploaded_file($_FILES['recipe-image']['tmp_name'], $targetPath)) {
                                $this->recipeDao->updateRecipeById($recipeId, $name, $cost, $prepTime, $cookingTime, $releaseDate, 1, $headcount, $newFileName . "." . $extensionFile, intval($IdRecipeCategory));
                                $this->updateIngredients($listIngredient, $listQuantity, $listUnit, $recipeId);
                                $this->updateSteps($listStep, $listQuantity, $listUnit, $recipeId); 
                            }
                        }
                    } else {
                        $this->recipeDao->updateRecipeByIdWithoutImage($recipeId, $name, $cost, $prepTime, $cookingTime, $releaseDate, 1, $headcount, intval($IdRecipeCategory)); 
                        $this->updateIngredients($listIngredient, $listQuantity, $listUnit, $recipeId);
                        $this->updateSteps($listStep, $listQuantity, $listUnit, $recipeId);
                    }

                    $this->redirect($this->location);
                } catch (Exception $ex) {
                    $this->setUpdateError($ex->getMessage());
                }
            } else {
                $this->setUpdateError("Les champs ne peuvent pas être vides");
            }
            $this->redirect(Configuration::get('index') . '/admin/recipe/' . $recipeId . "/edit");
        }
    }

    public function consult(Request $request)
    {
        $arguments = $request->routeArguments();
        $id = intval($arguments->get('id'));

        if (is_int($id)) {
            $recipe = $this->recipeDao->getRecipeById($id);
            $recipeIngredient = $this->recipeIngredientDao->getIngredientByIdRecipe($id);
            $recipeStep = $this->stepDao->getStepByRecipeId($id);

            return Response::view("consultRecipe", ["recipe" => $recipe, "recipeIngredients" => $recipeIngredient, "recipeSteps" => $recipeStep]);
        }
        return Response::view("404");
    }

    private function updateIngredients($listIngredient, $listQuantity, $listUnit, $recipeId) {
        for ($i = 0; $i < count($listIngredient); $i++) {
            $ingredientId = $this->ingredientDao->getIngredientIdByName($listIngredient[$i]);
            $unitId = $this->unitDao->getUnitByLabel($listUnit[$i]);
            $this->recipeIngredientDao->insertIfNotExistIngredientByRecipeId(intval($recipeId), intval($ingredientId), intval($listQuantity[$i]), intval($unitId));
            $this->recipeIngredientDao->updateIngredientByRecipeIngredientId(intval($ingredientId), intval($listQuantity[$i]), intval($unitId), intval($recipeId));
        }
    }

    private function updateSteps($listStep, $listQuantity, $listUnit, $recipeId) {
        for ($i = 0; $i < count($listStep); $i++) {
            $numberStep = $i + 1;
            $this->stepDao->insertIfNotExistStepByRecipeId($numberStep, $listStep[$i], $recipeId);
            $this->stepDao->updateStepByRecipeId($recipeId, $numberStep, $listStep[$i]);
        }
    }

    private function setUpdateError(string $message)
    {
        $this->error = $message;
    }
}
