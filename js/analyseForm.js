// Script starts on page load
$(document).ready(function () {
    $('a').tooltip();
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

     // Verification Formulaire

     var send = $('input[type=button]');
     var checkForm = function(){   
     }

     $('button[type=button]').on('click',function(e){
 validForm = true;
 var howYouKnow = $("#connuComment").val();
 var precisionHowYouKnow = $("#precisionConnuComment").val();

 //Coordonnées personelles        
 var civility = $("#selectCivility").val();
 var nom = $('#inputNom').val();
 var prenom = $('#inputPrenom').val();
 var regexDate = /^[^&\"`^@+:;%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{5,128}$/;
 var birthday = $('#inputDate').val();
 var telephone = $('#inputTel').val();
 var regexTel = /^((\+|00)33\s?|0)[67](\s?\d{2}){4}$/;
 var email = $('#inputEmail').val();
 var regexMail = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
 var statut = $('#selectState').val();
 var accompagnement = $('#selectAccompagne').val();
 var precisionAccompagnement = $('#precisionAccompagnement').val();
 var parcours = $('#areaClasse').val();

 //Permis
 var permisOui = $('#oui');
 var permisNon = $('#non');
 var permisPrecisions = $('#moyenDeLocomotion').val();

 //parcours
 var diplomeAucun = $('#checkAucun');
 var diplomeBrevet = $('#checkBrevet');
 var diplomeBepCap = $('#checkBepCap');
 var diplomeBepCapPrecisions = $('#precisionBetCap').val();
 var diplomeBac = $('#checkBac');
 var diplomeBacPrecisions = $('#precisionBac').val();
 var diplomeBtsDut = $('#checkBtsDut');
 var diplomeBtsDutPrecisions = $('#precisionBtsDut').val();
 var diplomeAutre= $('#checkAutre');
 var diplomeAutrePrecisions = $('#precisionAutreDiplome').val();

 //Projet
 var formation = $('#inputFormationEnvisagee').val();
 var metier = $('#inputMetierEnvisage').val();
 var cfa = $('#inputCFA').val();
 var nice = $('#checkNice');
 var niceAutours = $('#checkNiceAlentours');
 var niceOuest = $('#checkOuest');
 var niceEst = $('#checkEst');
 var autreZone = $('#checkPrecision');
 var autreZonePrecision = $('#precisionZone').val();

//Démarches réalisées pour rentrer en apprentissage
var recherchesDemarche = $('#checkRecherches');
var inscriptionCFA = $('#checkInscription');
var inscriptionCFAPrecision = $('#precisionInscription').val();
var portesOuvertes = $('#checkPortesOuvertes');
var portesOuvertesPrecision = $('#precisionPortesOuvertes').val();
var salon = $('#checkSalons');
var salonPrecision = $('#precisionSalons').val();
var decouvertes = $('#checkDecouvertes');
var decouvertesPrecision = $('#precisionDecouvertes').val();
var stages = $('#checkStages');
var stagesPrecision = $('#precisionStages').val();
var autresDemarche = $('#checkAutres');
var autresDemarchePrecision = $('#precisionAutres').val();

var parcoursChoix = $('#selectParcours').val();
var difficultes = $('#inputDifficultes').val();
var autresInformations = $('#inputAutreInfo').val();

//verification

if(howYouKnow == ""){ 
    alert("Choix inconnu dans la liste, faire un autre choix !");
    validForm = false;
}else{
    if(precisionHowYouKnow.length < 1 || isNaN(precisionHowYouKnow) == false){
        alert("Veuillez indiquer comment vous nous avez connu !");
        validForm = false;
    }
}

  //Debut Coordonnées personelles 

  if(civility == ""){
    alert("Veuillez indiquer votre sexe !");
    validForm = false;
}

if(nom == "" || isNaN(nom) == false){
    alert("Veuillez indiquer votre Nom !");
    validForm = false;
}

if(prenom == "" || isNaN(prenom) == false){
    alert("Veuillez indiquer votre Prénom !");
    validForm = false;
}

if (telephone == ""){
    alert("Indiquer votre numéro");
    validForm = false;
} else{
    if(regexTel.test(telephone) == false){
        alert("Numéro incorrect");
        validForm = false;
    }
}

if (email == ""){
    alert("Indiquer votre email");
    validForm = false;
} else{
    if(regexMail.test(email) == false){
        alert("Email incorrect");
        validForm = false;
    }
}

if(permisOui.is(':checked')){
    if(permisPrecisions == ""){
        alert("Veuillez indiquer votre moyen de locomotion");
        validForm = false;
    }
} else if (permisOui.is(':checked')==false && permisNon.is(':checked')==false){
    alert("Veuillez indiquer si oui ou non vous avez le permis"); 
    validForm = false;             
}

if(statut == ""){
    alert("Veuillez indiquer un statut !");
    validForm = false;
}

  //Fin Coordonnées personelles 



  // Debut Parcours

  if(parcours == ""){
     alert('Veuillez préciser votre parcours');
     validForm = false;
 }else{
     if(parcours.length >= 250){
         alert('250 caractéres maximum');
         validForm = false;
     }
 }

 if(accompagnement == ""){ 
    alert("Choix inconnu dans la liste d'accompagnent, faire un choix !");
    validForm = false;
}else{
    if(precisionAccompagnement.length < 1 || isNaN(precisionAccompagnement) == false){
        alert("Veuillez préciser un accompagnent !");
        validForm = false;
    }
}


// Début diplôme(s) obtenu(s)

if (diplomeAucun.is(':checked')){
    if (diplomeBepCap.is(':checked') || diplomeBrevet.is(':checked') || diplomeBac.is(':checked')  || diplomeBtsDut.is(':checked') || diplomeAutre.is(':checked')){
        alert('Cochez que Aucun');
        validForm = false;
    }
}

if (diplomeBepCap.is(':checked')){
    if(diplomeBepCapPrecisions == ""){
        alert("Veuillez preciser votre Bep/Cap");
        validForm = false;
    }
}

if (diplomeBac.is(':checked')){
    if(diplomeBacPrecisions == ""){
        alert('Veuillez preciser votre Bac');
        validForm = false;
    }
}

if (diplomeBtsDut.is(':checked')){
    if(diplomeBtsDutPrecisions == ""){
        alert('Veuillez preciser votre BTS/DUT');
        validForm = false;
    }
}

if (diplomeAutre.is(':checked')){
    if(diplomeAutrePrecisions == ""){
        alert('Veuillez preciser votre diplôme');
        validForm = false;
    }
}

if (diplomeAucun.is(':checked') == false && diplomeBepCap.is(':checked') == false && diplomeBrevet.is(':checked') == false && diplomeBac.is(':checked') == false && diplomeBtsDut.is(':checked') == false && diplomeAutre.is(':checked') == false){
    alert('Veuillez sélèctionner un diplome minimum ou case aucun');
    validForm = false;
}
  // Fin diplôme(s) obtenu(s)


  // Fin Parcours  


  // Début Projet

  if(formation == "" || isNaN(formation) == false){
    alert("Veuillez indiquer votre formation envisagée !");
    validForm = false;
}

if(metier == "" || isNaN(metier) == false){
    alert("Veuillez indiquer votre metier envisagé!");
    validForm = false;
}

if(cfa == "" || isNaN(cfa) == false){
    alert("Veuillez indiquer votre CFA envisagé!");
    validForm = false;
}
  // Fin Projet


  // Début Zone géographique
  if(nice.is(':checked') == false && niceAutours.is(':checked') == false && niceEst.is(':checked') == false && niceOuest.is(':checked') == false && autreZone.is(':checked') == false){
    alert('Veuillez sélectionner une zone');
    validForm = false;
}

if (nice.is(':checked')){
    if (niceAutours.is(':checked') || niceOuest.is(':checked') || niceEst.is(':checked') || autreZone.is(':checked')){
        alert('Vous ne pouvez en selectionner que un');
        validForm = false;
    }
}

if (niceAutours.is(':checked')){
    if (nice.is(':checked') || niceOuest.is(':checked') || niceEst.is(':checked') || autreZone.is(':checked')){
        alert('Vous ne pouvez en selectionner que un');
        validForm = false;
    }
}

if (niceOuest.is(':checked')){
    if (nice.is(':checked') || niceAutours.is(':checked') || niceEst.is(':checked') || autreZone.is(':checked')){
        alert('Vous ne pouvez en selectionner que un');
        validForm = false;
    }
}
if (niceEst.is(':checked')){
    if (nice.is(':checked') || niceAutours.is(':checked') || niceOuest.is(':checked') || autreZone.is(':checked')){
        alert('Vous ne pouvez en selectionner que un');
        validForm = false;
    }
}

if (autreZone.is(':checked')){
    if(autreZonePrecision == ""){
        alert('Veuillez preciser votre zone');
        validForm = false;
    }
    if (nice.is(':checked') || niceAutours.is(':checked') || niceOuest.is(':checked') || niceEst.is(':checked')){
        alert('Vous ne pouvez en selectionner que un');
        validForm = false;
    }
}
// Fin Zone géographique


// Début démarches réalisées pour rentrer en apprentissage

if(recherchesDemarche.is(':checked') == false && inscriptionCFA.is(':checked') == false && portesOuvertes.is(':checked') == false && salon.is(':checked') == false && decouvertes.is(':checked') == false && stages.is(':checked') == false && autresDemarche.is(':checked') == false ){
    alert('Veuillez sélectionner une démarches');
    validForm = false;
}

if (inscriptionCFA.is(':checked')){
    if(inscriptionCFAPrecision == ""){
        alert("Veuillez preciser votre Démarches auprés du CFA");
        validForm = false;
    }
}

if (portesOuvertes.is(':checked')){
    if(portesOuvertesPrecision == ""){
        alert("Veuillez preciser quelle portes ouvertes");
        validForm = false;
    }
}

if (salon.is(':checked')){
    if(salonPrecision == ""){
        alert("Veuillez preciser quel salon");
        validForm = false;
    }
}

if (decouvertes.is(':checked')){
    if(decouvertesPrecision == ""){
        alert("Veuillez preciser comment avez vous découverts le métier");
        validForm = false;
    }
}

if (stages.is(':checked')){
    if(stagesPrecision == ""){
        alert("Veuillez preciser votre stage");
        validForm = false;
    }
}

if (autresDemarche.is(':checked')){
    if(autresDemarchePrecision == ""){
        alert("Veuillez preciser votre démarche");
        validForm = false;
    }
}

// Fin démarches réalisées pour rentrer en apprentissage

if (parcoursChoix == ""){
    alert("Veuillez sélèctionner un parcours");
    validForm = false;
}

if (difficultes.length < 10){
    alert("10 caractéres min");
    validForm = false;
}

if (autresInformations.length < 10){
    alert("10 caractéres min");
    validForm = false;
}

if(validForm){
    $('form').submit();
}

});
});



