$(function() {

    console.log('loaded');


    $.getJSON( "/loadplants", function( data ) {

        $.each( data, function( i, item ) {
            $("#nav .cell").append('<span id="' + i + '">' + ' ' + item.name + '</div>');
        });

    });
});
