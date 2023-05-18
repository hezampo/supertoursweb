var curInd = 0;
$(function () { // document ready shortcut
    //change tabs by selection
   
    $("UL.templates LI").hover(function () {
        // hover in
        $(this).css("z-index", 2);
        animateB($(this).find("A"));
        animateB($(this).find("IMG"));
    }, function () {
        // hover out
        $(this).css("z-index", 0);
        reversAnimationB($(this).find("A"));
        reversAnimationB($(this).find("IMG"));
    });


    function animateB(obj) {
        $(obj).animate({
            height: "228",
            width: "278",
            left: "-=25",
            top: "-=25"
        }, "1000");
    }

    function reversAnimationB(obj) {
        $(obj).animate({
            height: "191",
            width: "234",
            left: "+=25",
            top: "+=25"
        }, "1000");
    }

    $("#containerr a").each(function (index) {
        var left = (index * 0) + cont_left;
        $(this).css("left", left + "px");
    });

});


