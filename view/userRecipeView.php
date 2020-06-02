<?php $this->title = "Mes recettes" ?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Vos recettes</h1>
    </div>
</section>

<div class="album text-muted">
    <div class="container">
    <?php
        if(count($recipes) > 0) { ?>
           <div class="row">
            <?php    
                foreach($recipes as $recipe) {
                    echo $recipe;
                } ?>
           </div>
           <?php
            } else { ?>
            <div class='text-center'>
                <p>Vous n'avez aucune recette créée pour l'instant !</p>
                <a href='<?= $this->getIndex()."/user/create-recipe"?>' class='btn btn-primary'>Créer ma première recette</a>
            </div>
            <?php }
        ?>
    </div>
</div>