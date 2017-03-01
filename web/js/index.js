$(function() {

    var translations = {
        month: {
            fr: {
                1: 'jan', 2: 'fév', 3: 'mar', 4: 'avr', 5: 'mai', 6: 'juin',
                7: 'juil', 8: 'aou', 9: 'sep', 10: 'oct', 11: 'nov', 12: 'déc'
            },
        }
    };

    // -- Array of Object
    var plants;

    /*
     * -- load data, create navigation spans
    */
    $.getJSON( "/loadplants", function( data ) {
        $.each( data, function( i, item ) {
            $("#nav .cell").append('<span id="' + i + '">' + ' ' + item.name + '</div>');
        });
        plants = data;
        setBodyHeight();
    });


    /*
     * -- click on a nav span
    */
    $(document).on("click","span",function(e) {

        // -- fade out bg
        var $bg = $("#bg");

        $bg.animate( {opacity: 0} , 2000 );

        // -- move active class
        $(".active").removeClass();

        $(this).addClass('active')

        // -- create image name
        var imageName = plants[$(this).attr('id')].name;

        imageName = imageName.replace(/ /g, '_');

        imageName = imageName.replace(/'/g, '--');

        // -- load new bg image
        var img = new Image();

        img.onload = function () {

            $bg.attr('src', this.src);
            resizeBg();
        }
        img.src = "/images/" + imageName + ".jpg"; // + cnt;

        // -- fill parameters table
        addParamsTable(plants[$(this).attr('id')], translations);


        // -- scroll to top in needed
        if ($("body").height() > $(window).height()) {

            setTimeout(function() {
                $('html, body').scrollTop(0);
            }, 10);
        }
    });


    /*
     * -- window resize
    */
    $(window).resize(function() {

        if ($("body").height() > $(window).height()) {
            $("body").css('height', 'auto');
        }
        else {
            $("body").css('height', '100%');
        }

        resizeBg();

    }).trigger("resize");


});

/*
 * -- create and add parameters table
*/
function addParamsTable(plant, translations) {

    var table = $('<table/>');

    // -- table title
    table.append(
        $('<tr>').append(
            $('<td>', { colspan: 3, text: plant.name })
        )
    );

    // -- first header
    table.append(
        $('<tr>', { class: 'header' }).append(
            $('<td>', { text: 'sol' })
        ).append(
            $('<td>', { text: 'qte de graines' })
        ).append(
            $('<td>', { text: 'distance' })
        )
    );

    // -- first values line
    var seedsQuantity = '';
    if (plant.seeds_quantity !== undefined) {
        seedsQuantity = plant.seeds_quantity;
    }

    var seedsQuantityUnit = '';
    if (plant.seeds_quantity_unit !== undefined) {
        seedsQuantityUnit = plant.seeds_quantity_unit.name;
    }

    var soils = '';
    var numSoils = plant.soil.length;
    $.each( plant.soil, function( i, item ) {
        soils += item.name;
        if (i !== numSoils - 1) {
            soils += ', '
        }
    });

    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { text: soils })
        ).append(
            $('<td>', { text: seedsQuantity + ' ' + seedsQuantityUnit })
        ).append(
            $('<td>', { text: plant.line_distance + ' x ' + plant.line_interval })
        )
    );

    // -- second header
    table.append(
        $('<tr>', { class: 'header' }).append(
            $('<td>', { colspan: 3, text: 'arrosage' })
        )
    );

    // -- second values line
    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { colspan: 3, text: plant.watering.name })
        )
    );

    // -- third header
    table.append(
        $('<tr>', { class: 'header' }).append(
            $('<td>', { text: 'semis sous abri' })
        ).append(
            $('<td>', { text: 'semi en terre' })
        ).append(
            $('<td>', { text: 'plantation' })
        )
    );

    // -- third values line
    var underCoverStart = '';
    if (plant.under_cover_start !== undefined) {
        underCoverStart =  translations.month.fr[plant.under_cover_start];
    }

    var underCoverEnd = '';
    if (plant.under_cover_end !== undefined) {
        underCoverEnd =  translations.month.fr[plant.under_cover_end];
    }

    var inGroundStart = '';
    if (plant.in_ground_start !== undefined) {
        inGroundStart =  translations.month.fr[plant.in_ground_start];
    }

    var inGroundEnd = '';
    if (plant.in_ground_end !== undefined) {
        inGroundEnd =  translations.month.fr[plant.in_ground_end];
    }

    var plantingStart = '';
    if (plant.planting_start !== undefined) {
        plantingStart =  translations.month.fr[plant.planting_start];
    }

    var plantingEnd = '';
    if (plant.planting_end !== undefined) {
        plantingEnd =  translations.month.fr[plant.planting_end];
    }

    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { text: underCoverStart + ' - ' + underCoverEnd })
        ).append(
            $('<td>', { text: inGroundStart + ' - ' + inGroundEnd })
        ).append(
            $('<td>', { text: plantingStart + ' - ' + plantingEnd })
        )
    );

    // -- fourth header
    table.append(
        $('<tr>', { class: 'header' }).append(
            $('<td>', { colspan: 3, text: 'récolte' })
        )
    );

    // -- fourth values line
    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { colspan: 3, text: translations.month.fr[plant.harvest_start] + ' - ' + translations.month.fr[plant.harvest_end] })
        )
    );

    $("#content .cell").html(table);
}

/*
 * -- background image resize
*/
function resizeBg() {

    var $window = $(window);
    var $bg = $("#bg");

    // -- image ratio
    imageAspectRatio = $bg.width() / $bg.height();

    // -- image orientation
    var imageOrientation = 'landscape';

    if (imageAspectRatio < 1) {
        imageOrientation = 'portrait';
    }


    // -- window ratio
    windowAspectRatio = $window.width() / $window.height();

    // -- window orientation
    var windowOrientation = 'landscape';

    if (windowAspectRatio < 1) {
        windowOrientation = 'portrait';
    }

    //
    // -- handle image and windows ratio - for background centering
    //
    if ( windowAspectRatio < imageAspectRatio ) {

        if (imageOrientation == 'portrait' && windowOrientation == 'landscape') {
            $bg.removeClass().addClass('bgwidth');
            $bg.css('margin-top', - ( ($bg.height() - $window.height()) / 2 ) );
            $bg.css('margin-left', 0 );
        }

        else {
            $bg.removeClass().addClass('bgheight');
            $bg.css('margin-left', - ( ($bg.width() - $window.width()) / 2 ) );
            $bg.css('margin-top', 0 );
        }
    }
    else {
        if (imageOrientation == 'portrait' && windowOrientation == 'portrait') {
            $bg.removeClass().addClass('bgheight');
            $bg.css('margin-left', - ( ($bg.width() - $window.width()) / 2 ) );
            $bg.css('margin-top', 0 );
        }
        else {
            $bg.removeClass().addClass('bgwidth');
            $bg.css('margin-top', - ( ($bg.height() - $window.height()) / 2 ) );
            $bg.css('margin-left', 0 );
        }
    }

    $bg.stop(true);

    $bg.animate( {opacity: 1} , 1000 );
}

/*
 * -- set body height
*/
function setBodyHeight() {
    if ($("body").height() > $(window).height()) {
        $("body").css('height', 'auto');
    }
    else {
        $("body").css('height', '100%');
    }
}
