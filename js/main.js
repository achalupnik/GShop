$(document).ready(function () {
    var mainNav = $("#mainNav").html();
    var f_form = $("#f_form").html();
    var mobileViewport = window.matchMedia("screen and (max-width: 580px)");

    mobileViewport.addListener(function(mq) {
        if(mq.matches) {
            $("#f_form").html("");
            $("#mainNav").html(mainNav+f_form);
        } else {
            $("#f_form").html(f_form);
            $("#mainNav").html(mainNav);
        }
    });
});
