$(function() {

    var route = 'home';

    if (window.location.pathname == '/calendar') {
        route = 'calendar';
    }

    // -- load bg image
    var img = new Image();
    var $bg = $("#bg");
    $bg.css('opacity' , 0)

    img.onload = function () {
        $("#bg").attr('src', this.src);
        resizeBg();
        $bg.animate( {opacity: 1} , 500 );
    }
    img.src = "/images/index1.jpg"; // + cnt;


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

        if (route === 'home') {
            $.each( data, function( i, item ) {
                $("#nav .cell").append('<span id="' + i + '">' + ' ' + item.name + '</div>');
            });
        }
        else if (route === 'calendar') {
            createCalendar(data, translations);
        }


        plants = data;
        // console.log(data);
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

        // -- get image name
        var imageName = plants[$(this).attr('id')].image;

        // -- load new bg image
        var img = new Image();

        img.onload = function () {

            $bg.attr('src', this.src);
            resizeBg();
        }
        img.src = "/images/" + imageName;

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


    var $nav;

    $(document).on("click","#content",function(e) {

        $nav = $('#nav .cell').detach();

        createCalendar(plants, translations);
    });


    // console.log(range(4,6));

});

function range(start, stop){
    var a=[start], b=start;
    while(b<stop){b++;a.push(b)}
    return a;
};





function createCalendar(plants, translations) {

    /*
    *  create a plantsCalendar
    *
    *    plantsCalendar[plant.name][property][monthArray]
    *
    */
    var plantsCalendar = {};

    $.each( plants, function( i, plant ) {

        $.each( ['under_cover', 'in_ground', 'planting', 'harvest'], function( i, property ) {

            if (plant[property + '_start']) {

                if (! plantsCalendar[plant.name]) {
                    plantsCalendar[plant.name] = [];
                }

                if (plant[property + '_end']) {
                    plantsCalendar[plant.name][property] = range(plant[property + '_start'], plant[property + '_end']);
                }
                else {
                    plantsCalendar[plant.name][property] = [plant[property + '_start']];
                }
            }
        });
    });


    /*
    *  plants annual Calendar output
    */
    var table = $('<table>', { class: 'calendar' });

    var thead = $('<thead>');
    var headerRow = $('<tr>');
    thead.append(headerRow.append($('<th>')));

    for (var month = 1; month <= 12; month++) {
        headerRow.append($('<th>', { html: "&nbsp;" + translations.month.fr[month] }));
    }

    table.append(thead);

    var tbody = $('<tbody>');

    $.each( plants, function( i, plant ) {

        var tableRow = $('<tr>');

        tableRow.append($('<td>', { text: plant.name }));

        for (var month = 1; month <= 12; month++) {

            var tableCell = $('<td>');

            $.each( ['under_cover', 'in_ground', 'planting', 'harvest'], function( i, property ) {

                if ($.inArray( month, plantsCalendar[plant.name][property] ) !== -1 ) {

                    if (property === 'under_cover') {
                        tableCell.append( $('<div>', { class: 'icon under_cover' }) );
                    }
                    else if (property === 'in_ground') {
                        tableCell.append( $('<div>', { class: 'icon in_ground' }) );
                    }
                    else if (property === 'planting') {
                        tableCell.append( $('<div>', { class: 'icon planting' }) );
                    }
                    else {
                        tableCell.append( $('<div>', { class: 'icon harvest' }) );
                    }
                }
            });

            tableRow.append(tableCell);
        }

        table.append(tbody).append(tableRow);
    });

    $("body").html(table);

    addFixedHeader(table);
}

function addFixedHeader(table) {

    table2 = table.clone();

    table2.css("position", "fixed");
    table2.css("top", 0);

    table2.find('tbody').css('opacity', 0);

    $("body").append(table2);

    $(window).scroll(function() {
        table2.css('left', - $(window).scrollLeft());
    });
}

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
            $('<td>', { text: 'graines / m2' })
        ).append(
            $('<td>', { text: 'P x L x R (cm)' })
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
            $('<td>', { text: plant.seeding_depth + ' x ' + plant.line_distance + ' x ' + plant.line_interval })
        )
    );

    // -- second header
    table.append(
        $('<tr>', { class: 'header' }).append(
            $('<td>', { text: 'arrosage' })
        ).append(
            $('<td>', { text: 'lévée (jours)' })
        ).append(
            $('<td>', { text: 'récolte (jours)' })
        )
    );

    // -- second values line
    var timeToSproutStart = '';
    if (plant.time_to_sprout_start !== undefined) {
        timeToSproutStart =  plant.time_to_sprout_start;
    }

    var timeToSproutEnd = '';
    if (plant.time_to_sprout_end !== undefined) {
        timeToSproutEnd =  plant.time_to_sprout_end;
    }

    var timeToSproutString = '';

    if (timeToSproutStart !== '') {
        timeToSproutString = timeToSproutStart;
        if (timeToSproutEnd !== '') {
            timeToSproutString += ' - ' + timeToSproutEnd;
        }
    }


    var timeToHarvestStart = '';
    if (plant.time_to_harvest_start !== undefined) {
        timeToHarvestStart =  plant.time_to_harvest_start;
    }

    var timeToHarvestEnd = '';
    if (plant.time_to_harvest_end !== undefined) {
        timeToHarvestEnd =  plant.time_to_harvest_end;
    }

    var timeToHarvestString = '';

    if (timeToHarvestStart !== '') {
        timeToHarvestString = timeToHarvestStart;
        if (timeToHarvestEnd !== '') {
            timeToHarvestString += ' - ' + timeToHarvestEnd;
        }
    }

    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { text: plant.watering.name })
        ).append(
            $('<td>', { text: timeToSproutString || '-' })
        ).append(
            $('<td>', { text: timeToHarvestString || '-' })
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

    var underCoverString = '';

    if (underCoverStart !== '') {
        underCoverString = underCoverStart;
        if (underCoverEnd !== '') {
            underCoverString += ' - ' + underCoverEnd;
        }
    }


    var inGroundStart = '';
    if (plant.in_ground_start !== undefined) {
        inGroundStart =  translations.month.fr[plant.in_ground_start];
    }

    var inGroundEnd = '';
    if (plant.in_ground_end !== undefined) {
        inGroundEnd =  translations.month.fr[plant.in_ground_end];
    }

    var inGroundString = '';

    if (inGroundStart !== '') {
        inGroundString = inGroundStart;
        if (inGroundEnd !== '') {
            inGroundString += ' - ' + inGroundEnd;
        }
    }


    var plantingStart = '';
    if (plant.planting_start !== undefined) {
        plantingStart =  translations.month.fr[plant.planting_start];
    }

    var plantingEnd = '';
    if (plant.planting_end !== undefined) {
        plantingEnd =  translations.month.fr[plant.planting_end];
    }


    var plantingString = '';

    if (plantingStart !== '') {
        plantingString = plantingStart;
        if (plantingEnd !== '') {
            plantingString += ' - ' + plantingEnd;
        }
    }

    table.append(
        $('<tr>', { class: 'values' }).append(
            $('<td>', { text: underCoverString })
        ).append(
            $('<td>', { text: inGroundString })
        ).append(
            $('<td>', { text: plantingString })
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

    $bg.animate( {opacity: 0} , 1000 );

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
