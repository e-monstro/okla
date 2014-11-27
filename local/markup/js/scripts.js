//Sticky Footer Function
function footerToBottom() {
    //$("body").css("margin-bottom", jQuery(".footer").outerHeight());
}

function setNavi($c, $i) {
    var current = $c.triggerHandler('currentPosition');
    $('#pagenumber span').text(current + 1);
    var $prev = ($i.is(':first-child')) ? $c.children().last() : $i.prev();
    var $next = $i.next();
}

$(document).ready(footerToBottom);
$(window).on("resize", footerToBottom);
$(document).ready(function () {

    $(".js-frd-vert").trigger("linkAnchors");
    $(".js-vert-main li a").fancybox();

    $("select").select2({
        minimumResultsForSearch: -1
    });


    var checkbox = $('input[type=checkbox]');
    if (checkbox.length > 0) {
        checkbox.each(function () {
            //$(this).prettyCheckable();
        })
    }

    $('.check-list-items li').each(function () {
        $(this).find($('input[type=checkbox]')).prettyCheckable();
    });

    var radiobox = $('input[type=radio]');
    if (radiobox.length > 0) {
        radiobox.each(function () {
            //$(this).prettyCheckable();
        })
    }

    $('.scroll-pane').jScrollPane();

    $(".fbox").fancybox({
        padding: 0
    });

    if($('#instafeed').length > 0){
        var feed = new Instafeed({
            clientId: 'bd15adcf901046049a5cc89fed0e2e23',
            target: 'instafeed',
            links: true,
            get: 'user',
             userId: 1520697826,
             accessToken: '1520697826.467ede5.00712746ebc746e5bb5aa595408dd82a',
            limit: 4,
            sortBy: 'most-recent',
            resolution: 'standard_resolution',
            template: '<li><a href="{{link}}" target="_blank"><img src="{{image}}" /></a></li>'
        });
        feed.run();
    }

});

$(window).load(function () {
    $(".js-fred1").carouFredSel({
        prev: ".fred-prev",
        next: ".fred-next",
        items: 1,
        scroll: {
            items: 1,
            onBefore: function (data) {
                setNavi($(this), data.items.visible);
            }
        },
        onCreate: function (data) {
            setNavi($(this), data.items);
        }
    });

    $(".js-fred2").carouFredSel({
        prev: ".fred-prev2",
        next: ".fred-next2",
        items: 6,
        scroll: {
            items: 1,
        },
        auto: {
            play: false
        }
    });

    $(".js-frd-vert").carouFredSel({
        synchronise: ['.js-vert-main', false],
        items: 4,
        scroll: {
            items: 1
        },
        prev: ".fred-prev3",
        next: ".fred-next3",
        direction: "up",
    });

    $(".js-vert-main").carouFredSel({
        items: 1,
        scroll: {
            fx: 'crossfade',
            items: 1
        }
    });
});