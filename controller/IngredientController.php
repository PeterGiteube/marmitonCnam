<?php

use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;

class IngredientController extends Controller {
    
    private $ingredientDao;

    public function __construct() {
        $this->ingredientDao = new IngredientDao();
    }

    public function list(Request $request) {    
        $ingredients = $this->ingredientDao->getIngredients();

        $result = array_map(function($ingredient) {
            return $ingredient->getName();
        }, $ingredients);
        
        return Response::json($result);       
    }
}