// Script starts on page load
$(document).ready(function () {
    // $('[data-toggle="tooltip"]').tooltip();
    $("#header").slideDown(3000);
    $("#prepa").fadeIn(3000);
    $("#seriousGame").fadeIn(3000);
    $("#footer").fadeIn(3000);
    if (window.innerWidth < 767) {
        $("#quiSommesNous").slideDown(3000);
        $("#mission").slideDown(3000);
    } else {
        var width = $(document).width();
        var halfWidth = width / 2;
        $("#quiSommesNous").animate({
            left: -halfWidth,
        }, 3000);
        $("#mission").animate({
            right: -halfWidth,
        }, 3000);
    }
    // function to toggle the form in/out of view
    // $("#toggle").click(function () {
    //     $("#formDiv").slideToggle("slow");
    // });

    // hide of the tooltip if phone
    // if (window.innerWidth < 767) {
    //     $('[data-toggle="tooltip"]').tooltip("disable");
    // };
    
});