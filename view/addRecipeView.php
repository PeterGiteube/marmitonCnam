<?php
if ($this->hasRole("ROLE_ADMIN")) {
    include_once "adminHeader.php";
}
$this->title = "Ajouter une recette";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <article class="card-body">
                    <header class="card-header text-center">
                        <h4 class="card-title mt-3">Ajouter une recette</h4>
                    </header>
                    <form method="POST" action="<?= $this->path('marmiton_add_recipe') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="upload-recipe-image">Image de recette</label>
                            <input type="file" accept="image/*" class="form-control-file" id="upload-recipe-image" name="recipe-image">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cost">Coût</label>
                                <select class="form-control" id="cost" name="cost">
                                    <option disabled selected value="">...</option>
                                    <option>Bon marché</option>
                                    <option>Coût moyen</option>
                                    <option>Coût élevé</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prep_time">Temps de préparation</label>
                                <input type="number" placeholder='En minutes...' class="form-control" id="prep_time" name="prep_time" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cooking_time">Temps de cuisson</label>
                                <input type="number" placeholder='En minutes...' class="form-control" id="cooking_time" name="cooking_time" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="head_count">Nombre de personnes</label>
                                <input type="number" class="form-control" id="head_count" name="head_count" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="select_category">Catégories de recette</label>
                                <select class="form-control" id="select_category" name='recipe_category' required>
                                    <option selected disabled value="">Sélectionner une catégorie</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        echo '<option value="'.$category->getName().'">'.$category->getName().'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button id='add-ingredient' type="button" class="btn btn-primary mb-3">Ajouter un ingredient</button>
                        <div id='div-add-ingredient'>
                            <div class="form-group">
                                <input list="recherche" autocomplete="off" id="ingredient" class="form-control ing" placeholder="Rechercher ingrédients">
                                <datalist id="recherche">
                                    <?php
                                    foreach ($ingredients as $ingredient) {
                                        echo '<option value="' . $ingredient->getName() . '">'.$ingredient->getName().'</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="number" id="quantity-ingredient" class="form-control ing" placeholder="Quantité">
                                </div>
                                <div class="form-group offset-md-1 col-md-3">
                                    <select class="form-control ing" id="select_unit">
                                        <?php
                                        foreach ($units as $unit) {
                                            echo '<option value="' . $unit->getLabel() . '">'.$unit->getLabel().'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="button" id="confirm-add-ingredient" class="btn btn-primary btn-sm offset-md-1 col-md-3">Ajouter</button>
                            </div>
                        </div>
                        <div class="form-row" id='list-ingredient'>
                        </div>
                        <div class="form-group">
                            <button type="button" id="add-step" class="btn btn-primary mb-3">Ajouter une étape</button>
                            <div id='div-add-step' class="form-group">
                                <div id="list-step">
                                </div>
                                <textarea class="form-control" id="text-step"></textarea>
                                <button type="button" id="confirm-step" class="btn btn-primary mt-3 float-right">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </article>
            </div>
            <button type="submit" id="add-recipe" class="btn btn-success mt-3 btn-lg btn-block">Ajouter une recette</button>
        </div>
    </div>
</div>