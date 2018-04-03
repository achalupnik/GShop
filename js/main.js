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

    var count = 0;
    $("#right_mark").click(function () {
        count++;
        var translate = count * $("#slider_wrapper").width();
        var last_li_position = $("#slider").children().last().position().left;
        var li_width = $("#slider").children().last().width();
        if(last_li_position+li_width>translate)
            $("#slider").css("transform","translate(-"+translate+"px)");
        else
            count--;

    });

    $("#left_mark").click(function () {
        if(count>0){
            count--;
            var translate = count * $("#slider_wrapper").width();
            $("#slider").css("transform","translate(-"+translate+"px)");
        }
    });
});
