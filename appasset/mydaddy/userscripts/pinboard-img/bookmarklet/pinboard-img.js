// <pinboard-img/>
//
// @link https://mrcoles.com/bookmarklet/
// @include https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js
// @include http://appasset.ru/pinboard-img/pinboard-img.css
//
var head = $('head')[0],
    poster_stylesheet = {
        position : "relative",
        width : "100%",
        'max-width' : "100%",
        display : "block"
    };

/* $('<link/>').attr({
    href : 'http://appasset.ru/pinboard-img/pinboard-img.css',
    type : 'text/css',
    rel : 'stylesheet'
}).appendTo(head); */

$(".bookmark").each(function() {
    var $poster = $();

    $.each(["jpg", "jpeg", "png", "gif", 'GIF'], function(i, ext) {
        $poster = $poster.add($("#bookmarks").find(".description").find("a[href$="   +   ext   +   "]"));
    });

    $poster.each(function  ()   {
        var   $wrapper   =   $("<div/>").addClass("poster-wrapper");

        $("<img/>").attr({
            src : $(this).attr("href")
        }).css(poster_stylesheet).appendTo($wrapper);

        $(this).replaceWith($wrapper);
        $wrapper.css(poster_stylesheet);
    });

    $().add('.user_navbar').add('.star').addClass('hide');
});

