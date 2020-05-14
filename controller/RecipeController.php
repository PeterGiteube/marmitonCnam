<?php

use Framework\Controller\Controller;
use Framework\View;

class RecipeController extends Controller {

    private $recipeDao;

    public function __construct() {
        $this->recipeDao = new RecipeDao();
    }

    public function validate() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");


        $validRecipes = $this->recipeDao->getValidRecipes();
        $result = array_map($this->formatHTMLRecipe(), $validRecipes);

        return new View("validateRecipe", ["recipes" => $result]);
    }

    public function waiting() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $waitingRecipes = $this->recipeDao->getWaitingRecipes();
        $result = array_map($this->formatHTMLRecipe(), $waitingRecipes);

        return new View("waitingRecipe", ["recipes" => $result]);
    }

    private function formatHTMLRecipe() {
        return function($recipe) {
            return "<tr>
                <td>".$recipe->getId()."</td>
                <td>".$recipe->getName()."</td>
                <td>".$recipe->getCost()."</td>
                <td>".$recipe->getPrepTime()."</td>
                <td>".$recipe->getCookingTime()."</td>
                <td>".$recipe->getReleaseDate()."</td>
                <td>".$recipe->getHeadCount()."</td>
            </tr>";
        };
    }
}