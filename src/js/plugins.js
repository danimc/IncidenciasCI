$(function () {
    
    //Background images slider


  
    //Submit Newsletter form to PHP file
    $("#asignarUsr").submit(function(event) {
        
        //stop form from submitting normally
        event.preventDefault();

        //get some values from elements on the page:
        var $form = $( this );

        $("#asignarUsr button").attr("disabled", "disabled");

        //Send the data using post
        var posting = $.post( 'acciones/funcionesTickets.php', $form.serialize() );

        //Show result
        posting.done(function( data ) {
          // window.location.href = "menuTickets.php";
            $("#asignarUsr button").removeAttr('disabled');

            $("#mensaje").hide().html(data).fadeIn();
            $('#myModal').modal('hide');
             setTimeout('document.location.reload()',1000);

        });
    });

//cambios de cat. en ticket

    $("#actualizaDatos").submit(function(event) {
        
        //stop form from submitting normally
        event.preventDefault();

        //get some values from elements on the page:
        var $form = $( this );

        $("#actualizaDatos button").attr("disabled", "disabled");

        //Send the data using post
        var posting = $.post( 'acciones/funcionesTickets.php', $form.serialize() );

        //Show result
        posting.done(function( data ) {
          // window.location.href = "menuTickets.php";
            $("#actualizaDatos button").removeAttr('disabled');

            $("#mensaje").hide().html(data).fadeIn();
            $('#myModal').modal('hide');
             setTimeout('document.location.reload()',1000);

        });
    });


    $("#seguimiento").submit(function(event) {
        
        //stop form from submitting normally
        event.preventDefault();

        //get some values from elements on the page:
        var $form = $( this );

        $("#seguimiento button").attr("disabled", "disabled");

        //Send the data using post
        var posting = $.post( 'acciones/funcionesTickets.php', $form.serialize() );

        //Show result
        posting.done(function( data ) {
          // window.location.href = "menuTickets.php";
            $("#seguimiento button").removeAttr('disabled');

            $("#mensaje").hide().html(data).fadeIn();
            $('#myModal').modal('hide');
             setTimeout('document.location.reload()',100);

        });
    });
    

/*Countdown for demo. Always add 18 days
var someDate = new Date();
var numberOfDaysToAdd = 18;
someDate.setDate(someDate.getDate() + numberOfDaysToAdd); */

//Countdown with real date
var someDate = new Date("October 01, 2017 23:59:59");
someDate.setDate(someDate.getDate()); 


})
