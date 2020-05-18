let userId = "";

$(document).ready( function () {
    $('#user-table').DataTable( {
        select: true
    });


    
} );


$('#delete-user').on('click',function() {
    
});

$('#delete-user-modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    userId = button.attr('data-id'); 
});

$('#confirm-delete-user').on('click',function(){
    $.ajax({
        method: "POST",
        url: "/marmitonCnam/admin/user/delete",
        data: {id : userId}
    })
        .done(function(msg) {
            console.log(msg);
            //data = JSON.parse(msg);
            //console.log(data);
        })
        .fail(function() {

        })
});


