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


    //Slider
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


    set_li_width(5);
    $(window).resize(function () {
        set_li_width(5);
    });


});

function set_li_width(number) {
    var m_right = parseInt($("ul#slider li:nth-child(1)").css('margin-right'),10);
    var m_left = parseInt($("ul#slider li:nth-child(1)").css('margin-left'),10);
    m_left = m_left - m_right;
    var full_width = $("#slider_wrapper").width();
    var new_li_width = (full_width - 2*number*m_right - m_left)/number;
    $("ul#slider li").width(new_li_width);
}







