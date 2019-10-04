$(document).ready(function () {
    $('.folder').click(function () {
        $('.subfolder').css("display", "block");
        $('.firstlvl').toggleClass('fa-caret-right fa-caret-down');
    });

    $('.blue').click(function () {
        $('.fas').css("color", "#78c8ff");
        $('.far').css("color", "#78c8ff");
        $('.fab').css("color", "#78c8ff");
    });

    $('.pink').click(function () {
        $('.fas').css("color", "#ff8fd4");
        $('.far').css("color", "#ff8fd4");
        $('.fab').css("color", "#ff8fd4");
    });

    $('.orange').click(function () {
        $('.fas').css("color", "#ffb482");
        $('.far').css("color", "#ffb482");
        $('.fab').css("color", "#ffb482");
    });

    // $.post( "ajax/index.php", function( data ) {
    //     $( ".result" ).html( data );
    // });
    //
    // $.post(
    //     'script.php',//nom du script de redirection
    //     {
    //         string_search : $('.search').val(),//$_POST['string_search]
    //     },
    //     function(data)
    //     {
    //         //data = tout ce qui est echo par le script.php
    //         $('#result_follower').html(data);
    //     },
    //     'html'//format de "data"
    // );
});