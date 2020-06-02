<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\View;

class ManageIngredientController extends Controller
{

    private $ingredientDao;

    public function __construct()
    {
        $this->ingredientDao = new IngredientDao();
    }

    public function manage()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $ingredients = $this->ingredientDao->getIngredients();
        $result = array_map($this->formatHTMLIngredient(), $ingredients);

        return Response::view("manageIngredient", ["ingredients" => $result]);
    }

    private function formatHTMLIngredient()
    {
        return function ($ingredient) {
            return "
            <tr id='ingredientRow" . $ingredient->getId() . "'>
                <td>" . $ingredient->getId() . "</td>
                <td>" . $ingredient->getName() . "</td>
                <td>" . $ingredient->getIdIngredientCategory() . "</td>
                <td><a class='btn btn-secondary' href='".Configuration::get('index')."/admin/ingredient/".$ingredient->getId()."/edit' role='button'>Edit</a> <button data-id='".$ingredient->getId()."'id='delete-ingredient' class='btn btn-danger' type='button' data-toggle='modal' data-target='#delete-ingredient-modal'>Supprimer</button></td>
            </tr>
            ";
        };
    }
}