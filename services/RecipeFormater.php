<?php

use Framework\Configuration;

class RecipeFormater {
    
    public function formatHTMLRecipes() {
        return function ($recipe) {
            $badge = "";
            if($recipe->getValid() === '1') {
                $badge = "<span class='badge badge-success'>Publiée</span>";
            } else {
                $badge = "<span class='badge badge-warning'>En attente</span>";
            }
            return "<div class='col-md-4 '>
                        <a href='" . Configuration::get("index") . "/recipe/" . $recipe->getId() . "/consult' class='card mb-5 shadow text-dark'> 
                            <img class='card-img-top img-card mx-auto' alt='Card image cap' src='". Configuration::get("index") ."/public/recipe-images/" . $recipe->getImageSource() . "'> 
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
                                <div class='col-md-4 offset-md-8'>
                                    " . $badge . "
                                </div>
                            </div>
                        </a>
                    </div>";
        };
    }
}