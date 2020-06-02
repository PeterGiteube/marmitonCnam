<?php

use Framework\Http\Response;

class HomeController {
    private $recipeDao;

    public function __construct() {
        $this->recipeDao = new RecipeDao();
    }

    public function home() {
        $recipes = $this->recipeDao->getValidRecipes();
        $resultRecipe = array_map($this->formatHTMLRecipes(), $recipes);
        

        return Response::view('home', ['recipes' => $resultRecipe]);
    }

    private function formatHTMLRecipes() {
        return function ($recipe) {
            return "<div class='col-md-4 '>
                        <a href='recipe/" . $recipe->getId() . "/consult' class='card mb-5 shadow text-dark'> 
                            <img class='card-img-top img-card mx-auto' alt='Card image cap' src='public/recipe-images/" . $recipe->getImageSource() . "'> 
                            <div class='card-body'>
                                <h5 class='card-title'>".$recipe->getName()."</h5>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <p><i class='fas fa-clock'></i> ". $recipe->getPrepTime() . " min</p>    
                                    </div>
                                    <div class='col-md-6'>
                                        <p><i class='fas fa-euro-sign'></i> " . $recipe->getCost() . "</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>";
        };
    }
}