let userId = "";
let recipeId = "";
let recipeIngredientId = "";
let stepId = "";
let ingredientId = "";
let nbStep = $('#list-step').children.length - 1;
let arrayIngredient = [];
let nbIngredient = 1;


$(document).ready(function () {
    $('.table').DataTable({
        select: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json'
        }
    });

    // Recette Modal 
    $('#delete-recipe-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        recipeId = button.attr('data-id');
    });

    // User Modal
    $('#delete-user-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        userId = button.attr('data-id');
    });

    // Recette Ingredient Modal
    $('#delete-recipe-ingredient-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        recipeIngredientId = button.attr('data-id');
    });


    // Step Modal
    $('#delete-step-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        stepId = button.attr('data-id');
    });

    // Ingredient Modal
    $('#delete-ingredient-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        ingredientId = button.attr('data-id');
    });


    // Delete Recipe
    $('#confirm-delete-recipe').on('click', function () {
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/recipe/delete",
            data: { id: recipeId }
        })
            .done(function (msg) {
                let data = JSON.parse(JSON.stringify(msg));
                if (data.success) {
                    toastr.success("La recette a bien été supprimée");
                    $('#delete-recipe-modal').modal('toggle');
                    console.log(recipeId);
                    $('#recipeRow' + recipeId).remove();
                }
            })
    });

    // Delete User
    $('#confirm-delete-user').on('click', function () {
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/user/delete",
            data: { id: userId }
        })
            .done(function (msg) {
                let data = JSON.parse(JSON.stringify(msg));
                if (data.success) {
                    toastr.success("L'utilisateur a bien été supprimé");
                    $('#delete-user-modal').modal('toggle');
                    console.log(userId);
                    $('#userRow' + userId).remove();
                }
            })
    });


    // Delete Ingredient
    $('#confirm-delete-ingredient').on('click', function () {
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/ingredient/delete",
            data: { id: ingredientId }
        })
            .done(function (msg) {
                console.log(msg);
                let data = JSON.parse(JSON.stringify(msg));
                if (data.success) {
                    console.log(data.success);
                    toastr.success("L'ingrédient a bien été supprimé");
                    $('#delete-ingredient-modal').modal('toggle');
                    console.log(ingredientId);
                    $('#ingredientRow' + ingredientId).remove();
                }
            })
    });

    // Delete Recipe Ingredient
    $('#confirm-delete-recipe-ingredient').on('click', function () {
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/recipe/delete/ingredient",
            data: { id: recipeIngredientId }
        })
            .done(function (msg) {
                let data = JSON.parse(JSON.stringify(msg));
                if (data.success) {
                    toastr.success("L'ingrédient a bien été supprimé de la recette !");
                    $('#delete-recipe-ingredient-modal').modal('toggle');
                    console.log(recipeIngredientId);
                    $('#recipe-ingredient-' + recipeIngredientId).remove();
                }
            })
    });

    // Delete Step
    $('#confirm-delete-step').on('click', function () {
        console.log("Step Id Ajax : " + stepId);
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/recipe/delete/step",
            data: { id: stepId }
        })
            .done(function (msg) {
                let data = JSON.parse(JSON.stringify(msg));
                if (data.success) {
                    toastr.success("L'étape a bien été supprimée de la recette !");
                    $('#delete-step-modal').modal('toggle');
                    console.log(stepId);
                    $('#step-' + stepId).remove();
                }
            })
    });

    $('#add-ingredient').on('click', function () {
        $('#div-add-ingredient').css('display', 'block');
    });

    $('#add-step').on('click', function () {
        $('#div-add-step').css('display', 'block');
    });

    // Verifier si la liste d'étape contient déjà des étapes ??????????
    if ($('#div-add-step').children.length >= 1) {
        $('#div-add-step').css('display', 'block');
    }

    $('#confirm-add-ingredient').on('click', function () {
        let ingredientName = $('#ingredient').val();    // récup datalist value
        let quantity = $('#quantity-ingredient').val(); // recup quantité value
        let unit = $('#select_unit').val();             // recup select value units

        if (ingredientName != "") {
            $('#ingredient').removeClass('border-danger');
            if (quantity != "") {
                $("#quantity-ingredient").removeClass("border-danger");
                $('#list-ingredient').append(
                    '<div class=\'row mb-2\' id=\'recipe-ingredient-' + ingredientName + '\'>' +
                    '<div class=\'col col-md-5\'>' +
                    '<input type=\'text\' class=\'form-control\' name=\'ingredient[]\' value="' + ingredientName + '"></div>' +
                    '<div class=\'col col-md-2\'>' +
                    '<input type=\'text\' class=\'form-control\' name=\'quantity[]\' value="' + quantity + '"> </div>' +
                    '<div class=\'col col-md-2\'>' +
                    '<input type=\'text\' class=\'form-control\' name=\'unit[]\' value="' + unit + '"> </div>' +
                    '<div class=\'col col-md-3 text-center\'> ' +
                    '<button data-id="' + ingredientName + '" id="recipe-ingredient" type=\'button\' data-target=\'#delete-recipe-ingredient-modal\' data-toggle=\'modal\' class=\'btn btn-outline-danger col-md-6 form-control\'><i class="fas fa-trash"></i></button></div>' +
                    '</div>');

                $('#ingredient').val('');
                $('#quantity-ingredient').val('');
            }
        } else {
            $(".ing").each(function () {
                if ($(this).val() == "") {
                    $(this).addClass("border-danger");
                }
            })
        }
    });

    $('#confirm-step').on('click', function () {
        let step = $('#text-step').val();

        if (step != "") {
            $('#text-step').removeClass('border-danger');
            $('#list-step').append(
                        '<div class=\'row mb-2\'\'>' +
                            '<div class=\'col col-md-1\'>' +
                                '<label>' + nbStep + '</label> ' +
                            '</div>' +
                            '<div class=\'col col-md-8\'>' +
                                '<textarea type=\'text\' class=\'form-control overflow-auto resize\' name=\'step[]\'>' + step + '</textarea>' +
                            '</div>' +
                            '<div class=\'col col-md-3 text-center\'> ' +
                                '<button id="step" type=\'button\' data-target=\'#delete-step-modal\' data-toggle=\'modal\' class=\'btn btn-outline-danger col-md-6 form-control\'><i class="fas fa-trash"></i></button>' +
                            '</div>' +
                            '</div>');


            $('#text-step').val('');
            nbStep++;
        } else {
            $('#text-step').addClass("border-danger");
        }
    });
});







