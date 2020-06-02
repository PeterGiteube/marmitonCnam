<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\View;

class RecipeIngredientController extends Controller
{

    private $recipeIngredientDao;

    public function __construct()
    {
        $this->recipeIngredientDao = new RecipeIngredientDao();
    }



    public function delete(Request $request)  {
        
        $post = $request->request();
        $id = intval($post->get('id'));
        $this->recipeIngredientDao->deleteRecipeIngredientById($id);

        return Response::json(["success" => true]); 
    }

}      
    