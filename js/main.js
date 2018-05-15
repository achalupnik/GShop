var count = 0;

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




//Slider - set number li elements
set_li_width();
$(window).resize(function() {
    set_li_width();
});

function set_li_width() {
    var wrapper_slider_x = parseInt($("#slider_wrapper").width(),10);
    var number_li = Math.round(wrapper_slider_x/250);

    var m_right = parseInt($("ul#slider li:nth-child(1)").css('padding-right'),10);
    var full_width = $("#slider_wrapper").width();
    var new_li_width = (full_width - 2*number_li*m_right)/number_li;
    $("ul#slider li").width(new_li_width);

    //When img height is > than width
    var li_amount = $("#slider li").length;
    for(var i=1; i<=li_amount; i++) {
        var img_height = $("#slider li:nth-child("+i+") img").height();
        var img_width = $("#slider li:nth-child("+i+") img").width();
        if (img_width < img_height) {
            $("#slider li:nth-child("+i+") img").height(img_width);
            $("#slider li:nth-child("+i+") img").width('auto');
            $("#slider li:nth-child("+i+") .to-align-img").css({"margin":"auto"});
        }
    }

    //Set height of right and left slider strip
    setTimeout(function () {
        $("#right_mark").height($("#slider li:first-child").height());
        $("#left_mark").height($("#slider li:first-child").height());
    },200);

}





//Insert data selected product into Modal of Slider (when clicked 'Show details')
function summon_modal(id) {
    var data = {"id": id};
    $.ajax({
        url:        'for_ajax_main/index_modal.php',
        data:       data,
        type:       'post',
        success:     function (data) {
            $("#for_swap").html(data);
        }
    });
}

//Display products in slider selected by pick brand
function select_table(id, table) {
    var data = {"id": id, "table": table};
    $.ajax({
        url:        'for_ajax_main/select_slider_elements.php',
        type:       'post',
        data:       data,
        success:    function (data) {
            $("#slider").html(data);
            set_li_width();
        }
    });

    //move slider to start position - x=0
        count=0;
        $("#slider").css("transform","translate(0px)");
}

//Change permissions for users
function change_permissions(id){
    var val = $("#user_permission").val();
    var data = {"id": id, "val": val};
    $.ajax({
       url:     'for_ajax/users_change_permissions.php',
       type:    'post',
       data:    data
    });
}


function add_to_cart() {
    if($("#cart_size").val()=='' || $("#cart_quantity").val()==0 || $("#cart_quantity").val() == '')
        $("#cart_error").html("&nbsp;Musisz wypełnić wszystkie pola");
    else{
        var cart_form = $("#add_to_cart_form").serialize();
        $.ajax({
            url:        'for_ajax_main/add_to_cart.php',
            type:       'post',
            data:       cart_form,
            success:    function (data) {
                if(data === '1'){
                    $("#cart_error").html("&nbsp;Musisz wypełnić wszystkie pola");
                }else if(data === '2')
                    $("#cart_error").html("&nbsp;Wymagana ilość towaru nie jest dostępna");
                else if(data === '3')
                    $("#cart_error").html("&nbsp;Musisz być zalogowany by mieć dostęp do tej funkcji");
                else{
                        $("#cart_error").html("");
                        //$("#close_add_to_cart_modal").trigger("click");
                    }
            },
            error:      function () {
                $("#cart_error").html("&nbsp;Coś poszło nie tak ...");
            }
        })
   }
}

function check_alert() {
    alert("działa ... chyba");
}



