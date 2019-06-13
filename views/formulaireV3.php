<?php require_once("./include/traitement.php"); ?>
<button id="toggle" class="btn">
	<h1 id="formulaire" class="titres">
		ça vous intéresse?
		<span id="text-form">Inscrivez-vous via notre formulaire</span>
	</h1>
</button>
<div id="formDiv" style="display: block"> 
	<!-- <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeXINiIiLh08iPph7XjTUml3Y-eGRA9n1CV9IflpcQS_lI3OA/viewform?embedded=true" width="100%" height="2048" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe> -->
	<?php
		echo ("<pre>");
		print_r($_POST['zoneGeographique']);
		print_r("<br>");
		// var_dump($listDatasToRegister);
		// print_r("<br>");
		//var_dump($listErrorsToDisplay);
		echo ("</pre>");	
		if (isset($listErrorsToDisplay)) {
			$cpt = 0;
			foreach ($listErrorsToDisplay as $key => $value) {
				if (is_array($value)) {
					if (count($value) > 0) {
						$cpt++;
					}
				}
			}
			if ($cpt > 0) {
				echo("<div class=\"divDisplayError\">");
				echo ("<h3>Erreurs!</h3>");
				foreach ($listErrorsToDisplay as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $subkey => $subvalue) {
							if ($subkey < count($value)) echo("<p class=\"errorMessage marginErrorMessage\">" . $subvalue . "</p>");
							else echo("<p class=\"errorMessage marginErrorMessage\">" . $subvalue . "</p>");
						}
					}
					else {
						if ($key < count($listErrorsToDisplay)) echo("<p class=\"errorMessage marginErrorMessage\">" . $value . "</p>");
						else echo("<p class=\"errorMessage marginErrorMessage\">" . $value . "</p>");
					}
				}
				echo("</div>");
			}
			else {
				if (isset($displaySuccessText) && count($displaySuccessText)>0) {
					echo(implode("", $displaySuccessText));
					unset($displaySuccessText);
					clearstatcache();
				}
				elseif (isset($displayErrorText)) {
				 	echo(implode("", $displayErrorText));
				 	unset($displayErrorText);
				}
			}
		}
	?>
	<section id="contactform" class="container p-5">
		<form method="POST" action="">
			<h3 class="py-3">Formulaire de récolte d'information</h3>
			<div class="form-row">
				<div class="form-group col-md-12">
					<select id="connuComment" class="form-control" name="connuComment[]">
						<option value="">Comment nous avez-vous connu ?</option>
						<option value="Salon" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Salon") !== false) { ?> selected <?php } ?>>Salon</option>
						<option value="Bus de l'orientation" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Bus de l'orientation") !== false) { ?> selected <?php } ?>>Bus de l'orientation</option>
						<option value="Réseaux Sociaux" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Réseaux Sociaux") !== false) { ?> selected <?php } ?>>Réseaux Sociaux</option>
						<option value="Mission Locale" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Mission Locale") !== false) { ?> selected <?php } ?>>Mission Locale</option>
						<option value="Pôle Emploi" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Pôle Emploi") !== false) { ?> selected <?php } ?>>Pôle Emploi</option>
						<option value="Association Montjoye" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Association Montjoye") !== false) { ?> selected <?php } ?>>Association Montjoye</option>
						<option value="CFA" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "CFA") !== false) { ?> selected <?php } ?>>CFA</option>
						<option value="Autre" <?php if(isset($_POST['connuComment'][0]) && strpos($_POST['connuComment'][0], "Autre") !== false) { ?> selected <?php } ?>>Autre</option>
					</select>
					<input type="text" name="connuComment[]" id="precisionConnuComment" class="form-control" placeholder="Merci de préciser." value="<?php if (isset($_POST['connuComment'][1])){ echo($_POST['connuComment'][1]); } ?>" />
					<span class="errorMessage">
						<?php
						if (isset($listErrorsToDisplay)) {
							foreach ($listErrorsToDisplay['connuComment'] as $key => $value) {
								if ($key == 1) echo($listErrorsToDisplay['connuComment'][$key] . "<br>");
								else echo($listErrorsToDisplay['connuComment'][$key]); 
							}
						}  
						?>
					</span>
				</div>
			</div>
			<h3 class="py-3">Coordonnées personelles</h3>
			<div class="form-row">
				<div class="form-group col-md-2">
					<select id="selectCivility" name="coordonnees[0]" class="form-control">
						<option value="">Civilité</option>
						<option value="Madame" <?php if(isset($_POST['coordonnees'][0]) && strpos($_POST['coordonnees'][0], "Madame") !== false) { ?> selected <?php } ?>>Madame</option>
						<option value="Monsieur" <?php if(isset($_POST['coordonnees'][0]) && strpos($_POST['coordonnees'][0], "Monsieur") !== false) { ?> selected <?php } ?>>Monsieur</option>
					</select>
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][0])) echo($listErrorsToDisplay['coordonnees'][0]); ?></span>
				</div>
				<div class="form-group col-md-5">
					<input name="coordonnees[1]" type="text" class="form-control" id="inputNom" placeholder="Nom" value="<?php if(isset($_POST['coordonnees'][1])) echo($_POST['coordonnees'][1]); ?>"/>
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][1])) echo($listErrorsToDisplay['coordonnees'][1]); ?></span>
				</div>
				<div class="form-group col-md-5">
					<input name="coordonnees[2]" type="text" class="form-control" id="inputPrenom" placeholder="Prénom" value="<?php if(isset($_POST['coordonnees'][2])) echo($_POST['coordonnees'][2]); ?>">
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][2])) echo($listErrorsToDisplay['coordonnees'][2]); ?></span>
				</div>
			</div>
			<div class="form-row">	
				<div class="input-group mb-3 col-md-4">
					<div class="input-group-prepend">
						<span class="input-group-text" id="addonDate"> Date de naissance</span>
					</div>
					<input type="date" name="coordonnees[3]" id="inputDate" class="form-control" value="<?php if(isset($_POST['coordonnees'][3])) echo($_POST['coordonnees'][3]); ?>">
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][3])) echo($listErrorsToDisplay['coordonnees'][3]); ?></span>
				</div>
				<div class="form-group col-md-3">
					<input name="coordonnees[4]" type="text" class="form-control" id="inputTel" placeholder="Téléphone" value="<?php if(isset($_POST['coordonnees'][4])) echo($_POST['coordonnees'][4]); ?>">
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][4])) echo($listErrorsToDisplay['coordonnees'][4]); ?></span>
				</div>
				<div class="form-group col-md-5">
					<input name="coordonnees[5]" type="email" class="form-control" id="inputEmail" placeholder="E-mail" value="<?php if(isset($_POST['coordonnees'][5])) echo($_POST['coordonnees'][5]); ?>">
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['coordonnees'][5])) echo($listErrorsToDisplay['coordonnees'][5]); ?></span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<div class="form-row">
						<label class="label col-md-8 m-md-0">Avez-vous un permis de conduire ? </label>
						<input type="radio" name="permis[0]" id="oui" class="form-control col-md-1" value="oui" <?php if(isset($_POST['permis'][0]) && strpos($_POST['permis'][0], "oui") !== false) { ?> checked <?php } ?>>
						<label class="col-md-1" for="oui">Oui</label>
						<input type="radio" name="permis[0]" id="non" value="non" class="form-control col-md-1" <?php if(isset($_POST['permis'][0]) && strpos($_POST['permis'][0], "non") !== false) { ?> checked <?php } ?>>
						<label class="col-md-1" for="non">Non</label>
						<input type="hidden" name="permis[]" value="" checked class="form-control col-md-1">
						<span class="errorMessage"><?php if (isset($listErrorsToDisplay['permis'][0])) echo($listErrorsToDisplay['permis'][0]); ?></span>
					</div>
				</div>
				<div class="form-group col-md-6">
					<input type="text" name="moyenDeLocomotion" id="moyenDeLocomotion" class="form-control" placeholder="Quel est votre moyen de locomotion ?" value="<?php if(isset($_POST['moyenDeLocomotion'])) echo($_POST['moyenDeLocomotion']); ?>">
					<span class="errorMessage"><?php if (isset($listErrorsToDisplay['moyenDeLocomotion'][0])) echo($listErrorsToDisplay['moyenDeLocomotion'][0]); ?></span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<select id="selectState" name="statut" class="form-control">
						<option value="">Quel est votre statut ?</option>
						<option value="Scolarisé" <?php if(isset($_POST['statut']) && strpos($_POST['statut'], "Scolarisé") !== false) { ?> selected <?php } ?>>Scolarisé</option>
						<option value="Demandeur d'emploi" <?php if(isset($_POST['statut']) && strpos($_POST['statut'], "Demandeur d'emploi") !== false) { ?> selected <?php } ?>>Demandeur d'emploi</option>
						<option value="En emploi" <?php if(isset($_POST['statut']) && strpos($_POST['statut'], "En emploi") !== false) { ?> selected <?php } ?>>En emploi</option>
						<option value="Autre" <?php if(isset($_POST['statut']) && strpos($_POST['statut'], "Autre (ex: garantie jeune, etc...") !== false) { ?> selected <?php } ?>>Autre (ex: garantie jeune, etc...)</option>
					</select>
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['statut'][0])) echo($listErrorsToDisplay['statut'][0]); ?>
					</span>
				</div>
				<div class="form-group col-md-6">
					<select id="selectAccompagne" name="accompagnement[]" class="form-control">
						<option value="">Êtes-vous accompagné ?</option>
						<option value="Mission locale" <?php if(isset($_POST['accompagnement'][0]) && strpos($_POST['accompagnement'][0], "Mission locale") !== false) { ?> selected <?php } ?>>Mission locale</option>
						<option value="Pôle emploi" <?php if(isset($_POST['accompagnement'][0]) && strpos($_POST['accompagnement'][0], "Pôle emploi") !== false) { ?> selected <?php } ?>>Pôle emploi</option>
						<option value="PLIE" <?php if(isset($_POST['accompagnement'][0]) && strpos($_POST['accompagnement'][0], "PLIE") !== false) { ?> selected <?php } ?>>PLIE</option>
						<option value="Autre" <?php if(isset($_POST['accompagnement'][0]) && strpos($_POST['accompagnement'][0], "Autre") !== false) { ?> selected <?php } ?>>Autre</option>
					</select>
					<input type="text" name="accompagnement[]" id="precisionAccompagnement" class="form-control" placeholder="Meci de préciser." value="<?php if(isset($_POST['accompagnement'][1])) echo($_POST['accompagnement'][1]); ?>">
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['accompagnement'][0])) echo($listErrorsToDisplay['accompagnement'][0]); ?>
					</span>
				</div>		
			</div>
			<h3 class="py-3">Parcours</h3>
			<div class="form-row">
				<div class="form-group col-md-12">
					<textarea name="parcoursText" id="areaClasse" class="form-control" rows="2" style="resize: none" placeholder="Dernière classe suivie"><?php if(isset($_POST['parcoursText'])) echo($_POST['parcoursText']); ?></textarea>
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['parcoursText'][0])) echo($listErrorsToDisplay['parcoursText'][0]); ?>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<h5>Diplôme(s) obtenu(s)</h5>
					<div class="custom-control custom-checkbox">
						<input name="diplome[0]" type="checkbox" class="custom-control-input" id="checkAucun" value="Aucun" <?php if(isset($_POST['diplome'][0]) && strpos($_POST['diplome'][0], "Aucun") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkAucun">Aucun</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="diplome[1]" type="checkbox" class="custom-control-input" id="checkBrevet" value="Brevet des collèges" <?php if(isset($_POST['diplome'][1]) && strpos($_POST['diplome'][1], "Brevet des collèges") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkBrevet">Brevet des collèges</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="diplome[2][]" type="checkbox" class="custom-control-input diplomeChecked" id="checkBepCap" data-toggle="collapse" data-target="#collapseprecisionBetCap" value="BEP-CAP" <?php if(isset($_POST['diplome'][2][0]) && strpos($_POST['diplome'][2][0], "BEP-CAP") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkBepCap">BEP - CAP</label>
						<div class="collapse diplomePrecision" id="collapseprecisionBetCap">
							<input type="text" id="diplomePrecisionBetCap" class="form-control" name="diplome[2][]" placeholder="Merci de préciser.">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="diplome[3][]" type="checkbox" class="custom-control-input diplomeChecked" id="checkBac" data-toggle="collapse" data-target="#collapseprecisionBac" value="BAC ou équivalent" <?php if(isset($_POST['diplome'][3][0]) && strpos($_POST['diplome'][3][0], "BAC ou équivalent") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkBac">Bac ou équivalent</label>
						<div class="collapse diplomePrecision" id="collapseprecisionBac">
							<input type="text" id="diplomePrecisionBac" class="form-control" placeholder="Merci de préciser." name="diplome[3][]">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="diplome[4][]" type="checkbox" class="custom-control-input diplomeChecked" id="checkBtsDut" data-toggle="collapse" data-target="#collapseprecisionBtsDut" value="BTS/DUT" <?php if(isset($_POST['diplome'][4][0]) && strpos($_POST['diplome'][4][0], "BTS/DUT") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkBtsDut">BTS/DUT</label>
						<div class="collapse diplomePrecision" id="collapseprecisionBtsDut">
							<input type="text" id="diplomePrecisionBtsDut" class="form-control" placeholder="Merci de préciser." name="diplome[4][]">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="diplome[5][]" type="checkbox" class="custom-control-input diplomeChecked" id="checkAutre" data-toggle="collapse" data-target="#collapseprecisionAutreDiplome" value="Autre" <?php if(isset($_POST['diplome'][5][0]) && strpos($_POST['diplome'][5][0], "Autre") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkAutre">Autre</label>
						<div class="collapse diplomePrecision" id="collapseprecisionAutreDiplome">
							<input name="diplome[5][]" type="text" id="diplomePrecisionAutreDiplome" class="form-control" placeholder="Merci de préciser." value="">
						</div>
						<br>
						<span class="errorMessage">
						<?php
						if (isset($listErrorsToDisplay)) {
							foreach ($listErrorsToDisplay['diplome'] as $key => $value) {
								if ($key < count($listErrorsToDisplay['diplome'])-1) echo($value . "<br>");
								else echo($value);
							}
						}  
						?>
						</span>
					</div>
					<h3 class="py-3">Le projet</h3>
					<div class="form-row">
						<div class="form-group col-md-4">
							<input class="form-control" type="text" id="inputFormationEnvisagee" placeholder="Formation envisagée" name="projet[formation]" value="<?php if(isset($_POST['projet']['formation'])) echo($_POST['projet']['formation']); ?>">
							<span class="errorMessage">
								<?php if (isset($listErrorsToDisplay['projet'][0])) echo($listErrorsToDisplay['projet'][0]); ?>
							</span>
						</div>
						<div class="form-group col-md-4">
							<input name="projet[metier]" class="form-control" type="text" id="inputMetierEnvisage" placeholder="Métier envisagé" value="<?php if(isset($_POST['projet']['formation'])) echo($_POST['projet']['formation']); ?>">
							<span class="errorMessage">
								<?php if (isset($listErrorsToDisplay['projet'][1])) echo($listErrorsToDisplay['projet'][1]); ?>
							</span>
						</div>
						<div class="form-group col-md-4">
							<input name="projet[cfa]" class="form-control" type="text" id="inputCFA" placeholder="CFA souhaité" value="<?php if(isset($_POST['projet']['cfa'])) echo($_POST['projet']['cfa']); ?>">
							<span class="errorMessage">
								<?php if (isset($listErrorsToDisplay['projet'][2])) echo($listErrorsToDisplay['projet'][2]); ?>
							</span>
						</div>					
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<h5>Zone géographique</h5>
					<div class="custom-control custom-checkbox">
						<input name="zoneGeographique[0]" type="checkbox" class="custom-control-input" id="checkNice" value="Nice" <?php if(isset($_POST['zoneGeographique'][0]) && strpos($_POST['zoneGeographique'][0], "Nice") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkNice">Nice</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="zoneGeographique[1]" type="checkbox" class="custom-control-input" id="checkNiceAlentours" value="Nice et alentours" <?php if(isset($_POST['zoneGeographique'][1]) && strpos($_POST['zoneGeographique'][1], "Nice et alentours") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkNiceAlentours">Nice et alentours</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="zoneGeographique[2]" type="checkbox" class="custom-control-input" id="checkOuest" value="Ouest du département" <?php if(isset($_POST['zoneGeographique'][2]) && strpos($_POST['zoneGeographique'][2], "Ouest du département") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkOuest">Ouest du département</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="zoneGeographique[3]" type="checkbox" class="custom-control-input" id="checkEst" value="Est du département" <?php if(isset($_POST['zoneGeographique'][3]) && strpos($_POST['zoneGeographique'][3], "Est du département") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkEst">Est du département</label>
					</div>

					<div class="custom-control custom-checkbox">
						<input name="zoneGeographique[4][]" type="checkbox" class="custom-control-input" id="checkPrecision" data-toggle="collapse" data-target="#collapseprecisionZone" value="Autre" <?php if(isset($_POST['zoneGeographique'][4][0]) && strpos($_POST['zoneGeographique'][4][0], "Autre") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkPrecision">Autre</label>
						<div class="collapse" id="collapseprecisionZone">
							<input name="zoneGeographique[4][]" type="text" id="precisionZone" class="form-control" placeholder="Merci de préciser." value="<?php if(isset($_POST['zoneGeographique'][4][1])) echo($_POST['zoneGeographique'][4][1]); ?>">
						</div>
					</div>
					<span class="errorMessage">
						<?php
						if (isset($listErrorsToDisplay)) {
							foreach ($listErrorsToDisplay['zoneGeographique'] as $key => $value) {
								if ($key < count($listErrorsToDisplay['zoneGeographique'])) echo($value . "<br>");
								else echo($value);
							}
						}  
						?>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<h5>Démarches réalisées pour rentrer en apprentissage</h5>
					<div class="custom-control custom-checkbox">
						<input name="demarches[0]" type="checkbox" class="custom-control-input" id="checkRecherches" value="Recherches d'entreprises" <?php if(isset($_POST['demarches'][0]) && strpos($_POST['demarches'][0], "Recherches d'entreprises") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkRecherches">Recherches d’entreprises</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[1][]" type="checkbox" class="custom-control-input" id="checkInscription" data-toggle="collapse" data-target="#collapseprecisionInscription" value="Inscription auprès des CFA" <?php if(isset($_POST['demarches'][1][0]) && strpos($_POST['demarches'][1][0], "Inscription auprès des CFA") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkInscription">Inscription auprès des CFA</label>
						<div class="collapse" id="collapseprecisionInscription">
							<input type="text" id="precisionInscription" class="form-control" placeholder="Merci de préciser." name="demarches[1][]" value="<?php if(isset($_POST['demarches'][1][1])) echo($_POST['demarches'][1][1]); ?>">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[2][]" type="checkbox" class="custom-control-input" id="checkPortesOuvertes" data-toggle="collapse" data-target="#collapseprecisionPortesOuvertes" value="Journées portes ouvertes" <?php if(isset($_POST['demarches'][2][0]) && strpos($_POST['demarches'][2][0], "Journées portes ouvertes") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkPortesOuvertes">Journées portes ouvertes</label>
						<div class="collapse" id="collapseprecisionPortesOuvertes">
							<input type="text" id="precisionPortesOuvertes" class="form-control" placeholder="Merci de préciser." name="demarches[2][]" value="<?php if(isset($_POST['demarches'][2][1])) echo($_POST['demarches'][2][1]); ?>">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[3][]" type="checkbox" class="custom-control-input" id="checkSalons" data-toggle="collapse" data-target="#collapseprecisionSalons" value="Salons" <?php if(isset($_POST['demarches'][3][0]) && strpos($_POST['demarches'][3][0], "Salons") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkSalons">Salons</label>
						<div class="collapse" id="collapseprecisionSalons">
							<input type="text" id="precisionSalons" class="form-control" placeholder="Merci de préciser" name="demarches[3][]" value="<?php if(isset($_POST['demarches'][3][1])) echo($_POST['demarches'][3][1]); ?>">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[4][]" type="checkbox" class="custom-control-input" id="checkDecouvertes" data-toggle="collapse" data-target="#collapseprecisionDecouvertes" value="Découvertes métiers" <?php if(isset($_POST['demarches'][4][0]) && strpos($_POST['demarches'][4][0], "Découvertes métiers") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkDecouvertes">Découvertes métiers</label>
						<div class="collapse" id="collapseprecisionDecouvertes">
							<input value="" type="text" id="precisionDecouvertes" class="form-control" placeholder="Merci de préciser." name="demarches[4][]" value="<?php if(isset($_POST['demarches'][4][1])) echo($_POST['demarches'][4][1]); ?>">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[5][]" type="checkbox" class="custom-control-input" id="checkStages" data-toggle="collapse" data-target="#collapseprecisionStages" value="Stages" <?php if(isset($_POST['demarches'][5][0]) && strpos($_POST['demarches'][5][0], "Stages") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkStages">Stages</label>
						<div class="collapse" id="collapseprecisionStages">
							<input type="text" id="precisionStages" class="form-control" placeholder="Merci de préciser." name="demarches[5][]" value="<?php if(isset($_POST['demarches'][5][1])) echo($_POST['demarches'][5][1]); ?>">
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input name="demarches[6][]" type="checkbox" class="custom-control-input" id="checkAutres" data-toggle="collapse" data-target="#collapseprecisionAutres" value="Autre" <?php if(isset($_POST['demarches'][6][0]) && strpos($_POST['demarches'][6][0], "Autre") !== false) { ?> checked <?php } ?>>
						<label class="custom-control-label" for="checkAutres">Autre</label>
						<div class="collapse" id="collapseprecisionAutres">
							<input value="" type="text" id="precisionAutres" class="form-control" placeholder="Merci de préciser." name="demarches[6][]" value="<?php if(isset($_POST['demarches'][6][1])) echo($_POST['demarches'][6][1]); ?>">
						</div>
					</div>
					<span class="errorMessage">
						<?php
						if (isset($listErrorsToDisplay)) {
							foreach ($listErrorsToDisplay['demarches'] as $key => $value) {
								if ($key < count($listErrorsToDisplay['demarches'])) {
									echo($value . "<br>");
								}
								else echo($value);
							}
						}  
						?>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4 mt-3">
					<select id="selectParcours" class="form-control" name="parcoursChoix">
						<option selected value="">Accompagnement souhaité</option>
						<option value="Parcours 1" <?php if(isset($_POST['parcoursChoix']) && strpos($_POST['parcoursChoix'], "Parcours 1") !== false) { ?> selected <?php } ?>>Parcours 1</option>
						<option value="Parcours 2" <?php if(isset($_POST['parcoursChoix']) && strpos($_POST['parcoursChoix'], "Parcours 2") !== false) { ?> selected <?php } ?>>Parcours 2</option>
						<option value="Parcours 3" <?php if(isset($_POST['parcoursChoix']) && strpos($_POST['parcoursChoix'], "Parcours 3") !== false) { ?> selected <?php } ?>>Parcours 3</option>
					</select>
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['parcoursChoix'][0])) echo($listErrorsToDisplay['parcoursChoix'][0]); ?>
					</span>
				</div>
				<div class="form-group col-md-4">
					<textarea name="difficultesText" rows="2" style="resize: none;" id="inputDifficultes" class="form-control" placeholder="Difficultés rencontrées"><?php if(isset($_POST['difficultesText'])) echo($_POST['difficultesText']); ?></textarea>
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['difficultesText'][0])) echo($listErrorsToDisplay['difficultesText'][0]); ?>
					</span>
				</div>
				<div class="form-group col-md-4">
					<textarea name="autreInfoText" rows="2" style="resize: none;" id="inputAutreInfo" class="form-control" placeholder="Autres informations éventuelles"><?php if(isset($_POST['autreInfoText'])) echo($_POST['autreInfoText']); ?></textarea>
					<span class="errorMessage">
						<?php if (isset($listErrorsToDisplay['autreInfoText'][0])) echo($listErrorsToDisplay['autreInfoText'][0]); ?>
					</span>
				</div>
			</div>
			<div class="form-group col-md-12 clearfix">
				<button class="btn  btn-lg btn-primary col-md-3 float-right mt-3" name="submit" type="submit" value="envoyer">Envoyer le formulaire</button>
			</div>				
		</form>
	</section>
</div>	

