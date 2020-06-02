<?php $this->title = $recipe->getName(); ?>

<div class="container">
    <div class="text-center mt-3">
        <div>
            
        </div>
        <div id="image">
            <img src="<?= $this->getIndex() . "/public/recipe-images/" . $recipe->getImageSource(); ?>" alt="<?=$recipe->getName()?>">
            <h1 class="font-weight-normal" id='title-recipe'><?= $recipe->getName(); ?></h1>
        </div>
        <div class="row mt-4">
            <span class="col-md-4"><i class='fas fa-clock'></i> Temps de préparation : <?= $recipe->getPrepTime();?> minutes</span>
            <span class="col-md-4"><i class="fas fa-male"></i> Nombre de personnes : <?= $recipe->getHeadCount();?></span>
            <span class="col-md-4"><i class='fas fa-euro-sign'></i> Coût de la recette : <?= $recipe->getCost();?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="mt-3">
                <h2 class="text-center">Ingrédients</h2>
            </div>
            <div class="rounded border p-2">
                <ul class="mt-3">
                <?php 
                    foreach($recipeIngredients as $recipeIngredient) {
                        echo "<li class='pt-2 mt-3'>" . $recipeIngredient->getQuantity() . " " . $recipeIngredient->getUnit()->getLabel() . " de " . $recipeIngredient->getIngredient()->getName() . "</li>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mt-3">
                <h2 class="text-center">Étapes</h2>
            </div>
            <div class="rounded border p-2">
                <?php
                    foreach($recipeSteps as $recipeStep) {
                        echo "<div class='d-flex col-md-12 mt-3'>
                                <div class='nb-step col-md-3'>
                                    Étape " . $recipeStep->getNumber() . " :
                                </div>
                                <div class='description-step col-md-9'>
                                    " . $recipeStep->getDescription() . "
                                </div>
                              </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>