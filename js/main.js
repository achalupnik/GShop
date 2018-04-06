$(document).ready(function () {

    //Main-menu responsiveness
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

    //Slider
    $("#left_mark").click(function () {
        if(count>0){
            count--;
            var translate = count * $("#slider_wrapper").width();
            $("#slider").css("transform","translate(-"+translate+"px)");
        }
    });


    //Slider - draggable
    $("#slider").draggable({
        appendTo: $("#slider_wrapper"),
        axis: "x"
    });
});




//Slider - set number li
var wrapper_slider_x = parseInt($("#slider_wrapper").width(),10);
var number_li = Math.round(wrapper_slider_x/250);
set_li_width(number_li);
$(window).resize(function () {
    var wrapper_slider_x = parseInt($("#slider_wrapper").width(),10);
    var number_li = Math.round(wrapper_slider_x/250);
    set_li_width(number_li);
});


function set_li_width(number_li) {
    var m_right = parseInt($("ul#slider li:nth-child(1)").css('padding-right'),10);
    var full_width = $("#slider_wrapper").width();
    var new_li_width = (full_width - 2*number_li*m_right)/number_li;
    $("ul#slider li").width(new_li_width);
}







