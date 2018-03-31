$(document).ready(function(){
    $(".container").css("box-shadow","1px 3px 2px #135331");
    $("nav").css("box-shadow","2px 2px 2px #135331");

    $(".not, button, input, select, nav, textarea").mouseenter(function(){
        $(this).css("box-shadow","0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)");
    });
    $(".not, button, input, select, textarea").mouseleave(function(){
        $(this).css("box-shadow","2px 2px 2px #229156");
    });
    $("nav").mouseleave(function(){
        $(this).css("box-shadow","2px 2px 2px #135331");
    });
        
});