// Script starts on page load
$(document).ready(function () {
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
    $("#toggle").click(function () {
    	$("#formDiv").slideToggle("slow");
    });

    // $( "input#checkBepCap" ).on( "change", function(){
    //     if ($(this).attr("checked") == "" || $(this).attr("aria-expanded") == true) {
    //         $("div#collapseprecisionBetCap").toggleClass("show", true);
    //         $(this).toggleClass("collapsed", true);
    //         var x = "Hey!";
    //     }
    //     else {
    //         $("div#collapseprecisionBetCap").toggleClass("show", false);
    //         $(this).toggleClass("collapsed", false);
    //     }
    //     console.log(x);
    // });
});

let selectHowDoYouKnow = document.getElementById("connuComment");
let inputHowDoYouKnowPrecision = document.getElementById("precisionConnuComment");
let listHowDoYouKnowAskingPrecision = [
    "Salon",
    "Réseaux Sociaux",
    "Autre"
];

switch (selectHowDoYouKnow.options.selectedIndex) {
    case 1:
    case 3:
    case 9:
        inputHowDoYouKnowPrecision.style.display = "block";
        inputHowDoYouKnowPrecision.style.marginTop = "8px";
        break;
    default:
        inputHowDoYouKnowPrecision.style.display = "none";
        break;
};

selectHowDoYouKnow.addEventListener("click", function() {
    let valueSelected = selectHowDoYouKnow.selectedOptions;
    for (let i=0; i<listHowDoYouKnowAskingPrecision.length; i++) {
        if (valueSelected[0].value == listHowDoYouKnowAskingPrecision[i].toString()) {
            inputHowDoYouKnowPrecision.style.display = "block";
            inputHowDoYouKnowPrecision.style.marginTop = "8px";
            break;
        }
        else {
            inputHowDoYouKnowPrecision.style.display = "none";
        }
    }
}, false);

let selectAccompaniment = document.getElementById("selectAccompagne");
let inputAccompanimentPrecision = document.getElementById("precisionAccompagnement");

switch (selectAccompaniment.options.selectedIndex) {
    case 4:
        inputAccompanimentPrecision.style.display = "block";
        inputAccompanimentPrecision.style.marginTop = "8px";
        break;
    default:
        inputAccompanimentPrecision.style.display = "none";
        break;
};

selectAccompaniment.addEventListener("click", function() {
    let valueSelected = selectAccompaniment.selectedOptions;
    if (valueSelected[0].value == "Autre") {
        inputAccompanimentPrecision.style.display = "block";
        inputAccompanimentPrecision.style.marginTop = "8px";
        console.log("I'm in");
    }
    else {
        inputAccompanimentPrecision.style.display = "none";
    }
}, false);

let inputDiplome = document.getElementsByClassName('diplomeChecked');
let divDiplomePrecision = document.querySelectorAll('div.diplomePrecision');
console.log(divDiplomePrecision);
console.log(typeof inputDiplome);

inputDiplome.addEventListener("change", function() {
    for (let i=0; i<inputDiplome.length; i++) {
        if (inputDiplome[i].checked) {
            divDiplomePrecision[i].style.display = "block";
            divDiplomePrecision[i].style.marginTop = "8px";
            console.log(i + "=>" + "true");
        }
        else {
             divDiplomePrecision[i].style.display = "none";
             console.log(i + "=>" + "false");
        }
    }
}, false);