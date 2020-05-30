let userId = "";
let recipeId = "";
let nbStep = 1;
let arrayIngredient = [];

$(document).ready(function () {
    $('#user-table').DataTable({
        select: true
    });

    $('.table-recipe').DataTable({
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

    // Delete Recipe
    $('#confirm-delete-recipe').on('click', function () {
        console.log(recipeId);
        $.ajax({
            method: "POST",
            url: "/marmitonCnam/admin/recipe/delete",
            data: { id: recipeId }
        })
        .done(function (msg) {
            let data = JSON.parse(msg);
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
            let data = JSON.parse(msg);
            if (data.success) {
                toastr.success("L'utilisateur a bien été supprimé");
                $('#delete-user-modal').modal('toggle');
                console.log(userId);
                $('#userRow' + userId).remove();
            }
        })
    });
});





$.ajax({
    method: "GET",
    url: "/marmitonCnam/admin/recipe/get/ingredient",
}).done(function (data) {

});




$('#add-ingredient').on('click', function () {
    $('#div-add-ingredient').css('display', 'block');
});

$('#add-step').on('click', function () {
    $('#div-add-step').css('display', 'block');
});

// Verifier si la liste d'étape contient déjà des étapes
if($('#list-step li').length >= 1) {
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
            $('#list-ingredient').append("<div class='form-group col-md-4'><label>Ingredient : </label>" + 
                                          '<input type=\'text\' class=\'form-control\' name=\'ingredient[]\' value="' + ingredientName + '"></div>' +
                                          "<div class='form-group col-md-4'><label>Quantité : </label>" + 
                                          "<input type='text' class='form-control' name='quantity[]' value='" + quantity + "'> </div>" +
                                          "<div class='form-group col-md-4'><label>Unité : </label>" + 
                                          "<input type='text' class='form-control ' name='unit[]' value='" + unit + "'> </div>"
                                        );
            $('#ingredient').val('');
            $('#quantity-ingredient').val('');

            //arrayIngredient.push({name: ingredientName, quantity: quantity, unit: unit});

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
        $('#list-step').append("<li>" +
                                    "<label>Étape " + nbStep + "</label> " +
                                    "<textarea type='text' class='form-control' name='step[]'>"+step+"</textarea>" +
                                "</li>"
                               );
        $('#text-step').val('');
        nbStep++;
    } else {
        $('#text-step').addClass("border-danger");
    }
});





