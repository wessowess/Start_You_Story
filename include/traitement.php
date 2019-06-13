<pre>
<?php
require_once('connectDB.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Clean data send by the user
function checkSendData($data) {	
	// Strip whitespace (or other characters) from the beginning and end of a string
	$data = trim($data);
	// Un-quotes a quoted string
	$data = stripslashes($data);
	// Convert special characters to HTML entities
	$data = htmlspecialchars($data);
	return $data;
}

// Stock into array variable $keys_form all index to superglobal $_POST. 
$keys_form = array_keys($_POST);

$listHowYouKnow = [
	"Salon",
	"Bus de l'orientation",
	"Réseaux Sociaux",
	"Mission Locale",
	"Pôle Emploi",
	"Association Montjoye",
	"CFA",
	"Autre"
];

$listHowDoYouKnowAskingPrecision = [
    "Salon",
    "Réseaux Sociaux",
    "Autre"
];

$listCivility = [
	"Monsieur",
	"Madame"
];

$listStatus = [
	"Scolarisé",
	"Demandeur d'emploi",
	"En emploi",
	"Autre"
];

$listAccompaniment = [
	"Mission locale",
	"Pôle emploi",
	"PLIE",
	"Autre"
];

$listDegree = [
	"Aucun",
	"Brevet des collèges",
	"BEP-CAP",
	"BAC ou équivalent",
	"BTS/DUT",
	"Autre"
];

$listGeographicalArea = [
	"Nice",
	"Nice et alentours",
	"Ouest du département",
	"Est du département",
	"Autre"
];

$listStep = [
	"Recherches d'entreprises",
	"Inscription auprès des CFA",
	"Journées portes ouvertes",
	"Salons",
	"Découvertes métiers",
	"Stages",
	"Autre"
];

$listDesiredAccompaniment = [
	"Parcours 1",
	"Parcours 2",
	"Parcours 3"
];

foreach ($keys_form as $value) {
	$listDatasToRegister[$value] = [];
	$listErrors[$value] = [];
}

foreach ($keys_form as $key_value) {
	switch ($key_value) {
		case 'connuComment':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			foreach ($_POST[$key_value] as $key => $value) {
				switch ($key) {
					case 0:
						if (!empty($value)) {
							if (in_array($value, $listHowYouKnow)) {
								$listDatasToRegister['connuComment'][] = $value;
							}
							else {
								$listErrors['connuComment'][] = "Choix inconnu dans la liste, faire un autre choix !";
							}
						}
						else {
							$listErrors['connuComment'][] = "Veuillez indiquer comment vous nous avez connu !";
						}
						break;
					case 1:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^[^&\"`^@+:;%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{5,128}$/", $value)) {
								$listDatasToRegister['connuComment'][] = $value;
							}
							else {
								if (strlen($value) < 5) {
									$listErrors['connuComment'][] = "Précision doit contenir 5 caractères minimum !";
								}
								else if (strlen($value) > 128) {
									$listErrors['connuComment'][] = "Précision doit contenir 128 caractères maximum !";
								}
								else {
									$listErrors['connuComment'][] = "Précision contient des caractères non acceptés !";
								}
							}
						} 
						else if (empty($value) && !empty($listDatasToRegister['connuComment'][0])) {
							if (array_search($listDatasToRegister['connuComment'][0], $listHowDoYouKnowAskingPrecision) !== false) {
							$listErrors['connuComment'][] = "Veuillez préciser quel(s) " . $listDatasToRegister['connuComment'][0] . "(s)";
							}
						}
						break;
					default:
						break;
				} 
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// print_r($_POST['connuComment'][0]);
			// if (!count($listErrors['connuComment']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs connuComment</b> => " . implode(",<br>\t\t     => ", $listErrors['connuComment']) . "<br>");
			// }
			// if (!count($listDatasToRegister['connuComment']) < 1) {
			// 	print_r("<b style=\"color:green\">List connuComment values</b> => " . implode(",<br>\t\t\t => ", $listDatasToRegister['connuComment']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'coordonnees':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			foreach ($_POST[$key_value] as $key => $value) {
				switch ($key) {
					case 0:
						if (!empty($value)) {
							if (in_array($value, $listCivility)) {
								$listDatasToRegister['coordonnees'][] = $value;
							}
							else {
								$listErrors['coordonnees'][0] = "Civilité inconnu dans la liste, faire un autre choix !";
							}
						}
						else {
							$listErrors['coordonnees'][0] = "Veuillez indiquer votre civilité !";
						}
						break;
					case 1:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^[^0-9_#&\"`^@+:,;.%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{3,100}$/", $value)) {
								$listDatasToRegister['coordonnees'][] = $value;
							}
							else {
								if (strlen($value) < 3) {
									$listErrors['coordonnees'][1] = "Nom 3 caractères minimum !";
								}
								else if (strlen($value) > 100) {
									$listErrors['coordonnees'][1] = "Nom 100 caractères maximum !";
								}
								else {
									$listErrors['coordonnees'][1] = "Nom contient des caractères non acceptés !";
								}
							}
						} 
						else {
							$listErrors['coordonnees'][1] = "Veuillez indiquer votre Nom !";
						}
						break;
					case 2:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^[^0-9_#&\"`^@+:,;.%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{3,100}$/", $value)) {
								$listDatasToRegister['coordonnees'][] = $value;
							}
							else {
								if (strlen($value) < 3) {
									$listErrors['coordonnees'][2] = "Prénom 3 caractères minimum !";
								}
								else if (strlen($value) > 100) {
									$listErrors['coordonnees'][2] = "Prénom 100 caractères maximum !";
								}
								else {
									$listErrors['coordonnees'][2] = "Prénom contient des caractères non acceptés !";
								}
							}
						} 
						else {
							$listErrors['coordonnees'][2] = "Veuillez indiquer votre Prénom !";
						}
						break;
					case 3:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^[\d]{4}([-]{1}[\d]{2}){2}$/", $value)) {
								if (strtotime($value) > strtotime("-14 years")) {
									$listErrors['coordonnees'][3] = "Vous devez avoir minimum 14 ans !";	
								}
								else if (strtotime($value) < strtotime("-60 years")) {
									$listErrors['coordonnees'][3] = "Vous devez avoir maximum 60 ans !";
								}
								else {
									$listDatasToRegister['coordonnees'][] = $value;
								}
							}
							else {
								$listErrors['coordonnees'][3] = "Date de naissance incorrect !";
							}
						} 
						else {
							$listErrors['coordonnees'][3] = "Veuillez indiquer votre date de naissance !";
						}
						break;
					case 4:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^0[1-9]([\/\-. ]?[0-9]{2}){4}/", $value)) {
								$listDatasToRegister['coordonnees'][] = $value;
							}
							else {
								$listErrors['coordonnees'][4] = "Téléphone incorrect !";
							}
						} 
						else {
							$listErrors['coordonnees'][4] = "Veuillez indiquer votre téléphone !";
						}
						break;
					case 5:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
								$explodeValue = explode(".", $value);
								if ((strlen($explodeValue[count($explodeValue)-1]) < 2) || (strlen($explodeValue[count($explodeValue)-1]) > 4)) {
									$listErrors['coordonnees'][5] = "L'extension \"" . $explodeValue[count($explodeValue)-1] . "\" de l'email n'est pas valide !";
								}
								else { 
									$listDatasToRegister['coordonnees'][] = $value;
								}
							}
							else {
								$listErrors['coordonnees'][5] = "Email incorrect !";
							}
						} 
						else {
							$listErrors['coordonnees'][5] = "Veuillez indiquer votre email !";
						}
						break;
					default:
						break;
				}
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['coordonnees']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs coordonnees</b> => " . implode(",<br>\t\t    => ", $listErrors['coordonnees']) . "<br>");
			// }
			// if (!count($listDatasToRegister['coordonnees']) < 1) {
			// 	print_r("<b style=\"color:green\">List coordonnees values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister['coordonnees']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'permis':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			switch ($_POST[$key_value][0]) {
				case 'oui':
					$listDatasToRegister['permis'][] = "Oui";
					break;
				case 'non':
					$listDatasToRegister['permis'][] = "Non";
					break;
				default:
					if (empty($_POST[$key_value][0])) {
						$listErrors['permis'][] = "Veuillez préciser si vous avez le permis !";
					}
					else {
						$listErrors['permis'][] = "Réponse incorrect !";
					}
					break;
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['permis']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs permis</b> => " . implode(",<br>\t\t    => ", $listErrors['permis']) . "<br>");
			// }
			// if (!count($listDatasToRegister['permis']) < 1) {
			// 	print_r("<b style=\"color:green\">List permis values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister['permis']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'moyenDeLocomotion':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			if (!empty($_POST[$key_value])) {
				$value = checkSendData($_POST[$key_value]);
				if (preg_match("/[^0-9_#&\"`^@+:,;.%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{3,50}$/", $value)) {
					$listDatasToRegister['moyenDeLocomotion'][] = $value;
				}
				else {
					if (strlen($value) < 3) {
						$listErrors['moyenDeLocomotion'][] = "Moyen de locomotion doit contenir 3 caractères minimum !";
					}
					else if (strlen($value) > 50) {
						$listErrors['moyenDeLocomotion'][] = "Moyen de locomotion doit contenir 50 caractères maximum !";
					}
					else {
						$listErrors['moyenDeLocomotion'][] = "Moyen de locomotion contient des caractères non acceptés !";
					}
				}
			}
			else {
				$listErrors['moyenDeLocomotion'][] = "Veuillez indiquer votre moyen de locomotion !";
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['moyenDeLocomotion']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs moyenDeLocomotion</b> => " . implode(",<br>\t\t    => ", $listErrors['moyenDeLocomotion']) . "<br>");
			// }
			// if (!count($listDatasToRegister['moyenDeLocomotion']) < 1) {
			// 	print_r("<b style=\"color:green\">List moyenDeLocomotion values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister['moyenDeLocomotion']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'statut':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			$value = $_POST[$key_value];
			if (!empty($value)) {
				if (in_array($value, $listStatus)) {
					$listDatasToRegister['statut'][] = $value;
				}
				else {
					$listErrors['statut'][] = "Choix inconnu dans la liste, faire un autre choix !";
				}
			}
			else {
				$listErrors['statut'][] = "Veuillez indiquer votre statut !";
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['statut']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs statut</b> => " . implode(",<br>\t\t    => ", $listErrors['statut']) . "<br>");
			// }
			// if (!count($listDatasToRegister['statut']) < 1) {
			// 	print_r("<b style=\"color:green\">List statut values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister['statut']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'accompagnement':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			foreach ($_POST[$key_value] as $key => $value) {
				switch ($key) {
					case 0:
						if (!empty($value)) {
							if (in_array($value, $listAccompaniment)) {
								$listDatasToRegister['accompagnement'][] = $value;
							}
							else {
								$listErrors['accompagnement'][] = "Choix inconnu dans la liste, faire un autre choix !";
							}
						}
						else {
							$listErrors['accompagnement'][] = "Veuillez indiquer un accompagnement !";
						}
						break;
					case 1:
						if (!empty($value)) {
							$value = checkSendData($value);
							if (preg_match("/^[\w][^&\"`^@+:;%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{4,70}$/", $value)) {
								$listDatasToRegister['accompagnement'][] = $value;
							}
							else {
								if (strlen($value) < 5) {
									$listErrors['accompagnement'][] = "Précision doit contenir 5 caractères minimum !";
								}
								else if (strlen($value) > 70) {
									$listErrors['accompagnement'][] = "Précision doit contenir 70 caractères maximum !";
								}
								else {
									$listErrors['accompagnement'][] = "Précision contient des caractères non acceptés !";
								}
							}
						} 
						else if (empty($value) && !empty($listDatasToRegister['accompagnement'][0])) {
							if ($listDatasToRegister['accompagnement'][0] === "Autre") {
								$listErrors['accompagnement'][] = "Veuillez préciser quel(s) " . $listDatasToRegister['accompagnement'][0] . "(s)";
							}
						}
						break;
					default:
						break;
				} 
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['accompagnement']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs accompagnement</b> => " . implode(",<br>\t\t       => ", $listErrors['accompagnement']) . "<br>");
			// }
			// if (!count($listDatasToRegister['accompagnement']) < 1) {
			// 	print_r("<b style=\"color:green\">List accompagnement values</b> => " . implode(",<br>\t\t\t   => ", $listDatasToRegister['accompagnement']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'diplome':
			/* A ffichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			$checkIfSelectedOneChoice = 0;
			foreach ($_POST[$key_value] as $key => $value) {
				switch ($key) {
					case 0:
					case 1:
						if (!empty($value)) {
							if (in_array($value, $listDegree)) {
								$listDatasToRegister['diplome'][] = $value;
							}
							else {
								$listErrors['diplome'][] = "Diplôme inconnu dans la liste !";
							}
						}
						else {
							$checkIfSelectedOneChoice++;
						}
						break;
					case 2:
					case 3:
					case 4:
					case 5:
						foreach ($value as $fieldKey => $fieldValue) {
							switch ($fieldKey) {
								case 0:
									if (!empty($fieldValue)) {
										if(in_array($fieldValue, $listDegree)) {
											$degree = $fieldValue;
											$listDatasToRegister['diplome'][$degree][] = $fieldValue;
											$checkedDegree = 1;
										}
										else {
											$listErrors['diplome'][] = "Diplôme inconnu dans la liste !";
										}
									}
									else {
										$checkedDegree = 0;
										$checkIfSelectedOneChoice++;
									}
									break;
								case 1:
									if ($checkedDegree === 1) {
										if (!empty($fieldValue)) {
											$fieldValue = checkSendData($fieldValue);
											if (preg_match("/^[^&\"`^@+:;%µ£¤§!?~°\<\>\$\=\|\{\}\[\]\\\*\/]{5,70}$/", $fieldValue)) {
												$listDatasToRegister['diplome'][$degree][] = $fieldValue;
											}
											else {
												if (strlen($fieldValue) < 5) {
													$listErrors['diplome'][] = "L'intitulé du " . $listDatasToRegister['diplome'][$degree][0] . " doit contenir 5 caractères minimum !";
												}
												else if (strlen($fieldValue) > 70) {
													$listErrors['diplome'][] = "L'intitulé du " . $listDatasToRegister['diplome'][$degree][0] . " doit contenir 70 caractères maximum !";
												}
												else {
													$listErrors['diplome'][] = "L'intitulé du " . $listDatasToRegister['diplome'][$degree][0] . " contient des caractères non acceptés !";
												}
											}
										}
										else if (empty($fieldValue) && $checkedDegree === 1) {
											if ($listDatasToRegister['diplome'][$degree][0] != "Autre") {
												$listErrors['diplome'][] = "Veuillez préciser l'intitulé du " . $listDatasToRegister['diplome'][$degree][0] . " !";
											}
											else {
												$listErrors['diplome'][] = "Veuillez préciser l'intitulé du diplôme " . $listDatasToRegister['diplome'][$degree][0] . " !";
											}
										}
									}
									break;
								default:
									$listErrors['diplome'][] = "Impossible d'analyser les valeurs entrées pour les diplômes !";
									break;
							}
						}
						break;
					default:
						$listErrors['diplome'][] = "Impossible d'analyser les valeurs entrées pour les diplômes !";
						break;
				}
			}
			if ($checkIfSelectedOneChoice >= 4 && !isset($listDatasToRegister['diplome'])) {
				$listErrors['diplome'][] = "Veuillez faire un choix dans la liste des diplômes !";
				// print_r($checkIfSelectedOneChoice);
			}
			/* Début Algo d'affichage pour l'aide au dev */
			/*if (!count($listErrors['diplome']) < 1) {
				print_r("<b style=\"color:red\">Erreurs diplome</b> => " . implode(",<br>\t\t=> ", $listErrors['diplome']) . "<br>");
			}
			if (!count($listDatasToRegister['diplome']) < 1) {
				// print_r($listDatasToRegister['diplome']);
				print_r("<b style=\"color:green\">List diplome values</b> => ");
				$cpt = 0;
				foreach ($listDatasToRegister['diplome'] as $degreeKey => $degreeValue) {
					$cpt++; 
					if (is_array($degreeValue)) {
						$degreeValue = implode(" => ", $degreeValue);
						if ($cpt === count($listDatasToRegister['diplome'])) {
							print_r(implode(" ", $listDatasToRegister['diplome'][$degreeKey]) . "<br>");
						}
						else {
							print_r(implode(" ", $listDatasToRegister['diplome'][$degreeKey]) . "<br>\t\t    => ");	
						}
					}
					else {
						print_r($listDatasToRegister['diplome'][$degreeKey] . "<br>\t\t    => ");
					}
				}
			}
			print_r("<br>");*/
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'projet':
			/* A ffichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			foreach ($_POST[$key_value] as $projectKey => $projectValue) {
				switch ($projectKey) {
					case 'formation':
					case 'metier':
					case 'cfa':
						if (!empty($projectValue)) {
							$projectValue = checkSendData($projectValue);
							if (preg_match("/^[^&\"`^@+:;%µ£¤§!?~°\<\>\$\=\|\{\}\[\]\\\*\/]{10,128}$/", $projectValue)) {
								$listDatasToRegister['projet'][] = $projectValue;
							}
							else {
								if (strlen($projectValue) < 10) {
									if ($projectKey === "formation") {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaitée doit contenir 10 caractères minimum !";
									}
									else if ($projectKey === "metier") {
										$listErrors['projet'][] = "Le texte sur votre métier souhaité doit contenir 10 caractères minimum !";
									}
									else {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaité doit contenir 10 caractères minimum !";
									}
								}
								else if (strlen($projectValue) > 128) {
									if ($projectKey === "formation") {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaitée doit contenir 128 caractères maximum !";
									}
									else if ($projectKey === "metier") {
										$listErrors['projet'][] = "Le texte sur votre métier souhaité doit contenir 128 caractères maximum !";
									}
									else {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaité doit contenir 128 caractères maximum !";
									}
								}
								else {
									if ($projectKey === "formation") {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaitée contient des caractères non acceptés !";
									}
									else if ($projectKey === "metier") {
										$listErrors['projet'][] = "Le texte sur votre métier souhaité contient des caractères non acceptés !";
									}
									else {
										$listErrors['projet'][] = "Le texte sur votre " . $projectKey . " souhaité contient des caractères non acceptés !";
									}
								}
							}
						}
						else {
							if ($projectKey === "formation") {
								$listErrors['projet'][] = "Veuillez préciser la " . $projectKey . " que vous souhaitez !";
							}
							else {
								if ($projectKey === "metier") {
									$projectKey = "métier";
								}
								$listErrors['projet'][] = "Veuillez préciser le " . $projectKey . " que vous souhaitez !";
							}
						}
						break;
					default:
						break;
				}
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['projet']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs projet</b> => " . implode(",<br>\t       => ", $listErrors['projet']) . "<br>");
			// }
			// if (!count($listDatasToRegister['projet']) < 1) {
			// 	print_r("<b style=\"color:green\">List projet values</b> => " . implode(",<br>\t\t   => ", $listDatasToRegister['projet']) . "<br>");
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'zoneGeographique':
			/* A ffichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			foreach ($_POST[$key_value] as $key => $value) {
				if (empty($_POST[$key_value][4][0])) {
					array_pop($_POST[$key_value]);
				}
				else {
					$arrayGeographicalArea[] = $value;
				}
				if ($key != 4 && !empty($value)) {
					$arrayGeographicalArea[] = $value;
				}
			}
			if (isset($arrayGeographicalArea)) {
				if (count($arrayGeographicalArea) > 1) {
					$listErrors['zoneGeographique'][] = "Veuillez séléctionner une seule zone géographique !";
				}
				else if (count($arrayGeographicalArea) == 1) {
					if (is_array($arrayGeographicalArea[count($arrayGeographicalArea)-1])) {
						foreach ($arrayGeographicalArea[count($arrayGeographicalArea)-1] as $key => $value) {
							switch ($key) {
								case 0:
									if (in_array($value, $listGeographicalArea)) {
										$listDatasToRegister['zoneGeographique'][] = $value;
									}
									else {
										$listErrors['zoneGeographique'][] = "Zone géographique non définie !";
									}
									break;
								case 1:
									if (!empty($value)) {
										$value = checkSendData($value);
										if (preg_match("/^[^&\"`^@+:;%µ£¤§!?~°\(\)\<\>\$\=\|\{\}\[\]\\\*\/]{8,50}$/", $value)) {
											$listDatasToRegister['zoneGeographique'][] = $value;
										}
										else {
											if (strlen($value) < 8) {
												$listErrors['zoneGeographique'][] = "La précision géographique doit contenir 8 caractères minimum !";
											}
											else if (strlen($value) > 50) {
												$listErrors['zoneGeographique'][] = "La précision géographique doit contenir 50 caractères maximum !";
											}
											else {
												$listErrors['zoneGeographique'][] = "La précision géographique contient des caractères non acceptés !";
											}
										}
									}
									else {
										$listErrors['zoneGeographique'][] = "Veuillez préciser votre zone géographique !";
									}
									break;
								default:
									$listErrors['zoneGeographique'][] = "Impossible de traiter votre zone géographique !";
									break;
							}
						}
					}
					else {
						if (in_array($arrayGeographicalArea[count($arrayGeographicalArea)-1], $listGeographicalArea)) {
							$listDatasToRegister['zoneGeographique'][] = $arrayGeographicalArea[count($arrayGeographicalArea)-1];
						}
						else {
							$listErrors['zoneGeographique'][] = "Zone géographique non définie !";
						}
					}
				}
			}
			else {
				$listErrors['zoneGeographique'][] = "Veuillez choisir une zone géographique !";
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['zoneGeographique']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs zoneGeographique</b> => " . implode(",<br>\t       => ", $listErrors['zoneGeographique']) . "<br>");
			// }
			// else {
			// 	if (!count($listDatasToRegister['zoneGeographique']) < 1) {
			// 		print_r("<b style=\"color:green\">List zoneGeographique values</b> => " . implode(",<br>\t\t\t     => ", $listDatasToRegister['zoneGeographique']) . "<br>");
			// 	}
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'demarches':
			/* A ffichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			$checkIfSelectedOneStepChoice = 0;
			foreach ($_POST[$key_value] as $key => $value) {
				switch ($key) {
					case 0:
						if (!empty($value)) {
							if (in_array($value, $listStep)) {
								$listDatasToRegister['demarches'][$value] = $value;
							}
							else {
								$listErrors['demarches'][] = "Démarches non définie !";
							}
						}
						else {
							$checkIfSelectedOneStepChoice++;
						}
						break;
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
					case 6:
						foreach ($value as $stepKey => $stepValue) {
							switch ($stepKey) {
								case 0:
									if (!empty($stepValue)) {
										if(in_array($stepValue, $listStep)) {
											$step = $stepValue;
											$listDatasToRegister['demarches'][$step][] = $stepValue;
											$checkedStep = 1;
										}
										else {
											$listErrors['demarches'][] = "Démarche inconnu dans la liste !";
										}
									}
									else {
										$checkedStep = 0;
										$checkIfSelectedOneStepChoice++;
									}
									break;
								case 1:
									if ($checkedStep === 1) {
										if (!empty($stepValue)) {
											$stepValue = checkSendData($stepValue);
											if (preg_match("/^[^&\"`^@+:;%µ£¤§!?~°\<\>\$\=\|\{\}\[\]\\\*\/]{10,255}$/", $stepValue)) {
												$listDatasToRegister['demarches'][$step][] = $stepValue;
											}
											else {
												if (strlen($stepValue) < 10) {
													$listErrors['demarches'][] = "Précision pour " . $listDatasToRegister['demarches'][$step][0] . " doit contenir 10 caractères minimum !";
												}
												else if (strlen($stepValue) > 255) {
													$listErrors['demarches'][] = "Précision pour " . $listDatasToRegister['demarches'][$step][0] . " doit contenir 255 caractères maximum !";
												}
												else {
													$listErrors['demarches'][] = "Précision pour " . $listDatasToRegister['demarches'][$step][0] . " contient des caractères non acceptés !";
												}
											}
										}
										else if (empty($stepValue) && $checkedStep === 1) {
											$listErrors['demarches'][] = "Veuillez préciser les démarches concernant " . $listDatasToRegister['demarches'][$step][0] . " !";
										}
									}
									break;
								default:
									$listErrors['demarches'][] = "Impossible de traiter la démarche !";
									break;
							}
						}
						break;
					default:
						$listErrors['demarches'][] = "Impossible de traiter les démarches !";
						break;
				}
			}

			if ($checkIfSelectedOneStepChoice >= 6 && !isset($listDatasToRegister['demarches'])) {
				$listErrors['demarches'][] = "Veuillez faire un choix dans la liste des démarches !";
			}
			/* Début Algo d'affichage pour l'aide au dev */
			// if (!count($listErrors['demarches']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs demarches</b> => " . implode(",<br>\t\t=> ", $listErrors['demarches']) . "<br>");
			// }
			// if (!count($listDatasToRegister['demarches']) < 1) {
			// 	// print_r($listDatasToRegister['demarches']);
			// 	print_r("<b style=\"color:green\">List demarches values</b> => ");
			// 	$cpt = 0;
			// 	foreach ($listDatasToRegister['demarches'] as $stepKey => $stepValue) {
			// 		$cpt++; 
			// 		if (is_array($stepValue)) {
			// 			$stepValue = implode(" => ", $stepValue);
			// 			if ($cpt === count($listDatasToRegister['demarches'])) {
			// 				print_r(implode(" -> ", $listDatasToRegister['demarches'][$stepKey]) . "<br>");
			// 			}
			// 			else {
			// 				print_r(implode(" -> ", $listDatasToRegister['demarches'][$stepKey]) . "<br>\t\t      => ");	
			// 			}
			// 		}
			// 		else {
			// 			print_r($listDatasToRegister['demarches'][$stepKey] . "<br>\t\t      => ");
			// 		}
			// 	}
			// }
			// print_r("<br>");
			/* Fin Algo d'affichage pour l'aide au dev */
			break;
		case 'parcoursChoix':
			/* Affichage pour l'aide au dev */
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			if (!empty($_POST[$key_value])) {
				if (in_array($_POST[$key_value], $listDesiredAccompaniment)) {
					$listDatasToRegister['parcoursChoix'][] = $_POST[$key_value];
				}
				else {
					$listErrors['parcoursChoix'][] = "Choix de parcours d'accompagnement non définie !";
				}
			}
			else {
				$listErrors['parcoursChoix'][] = "Choisir un parcours d'accompagnement !";
			}
			// if (!count($listErrors['parcoursChoix']) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs parcoursChoix</b> => " . implode(",<br>\t\t    => ", $listErrors['parcoursChoix']) . "<br>");
			// }
			// if (!count($listDatasToRegister['parcoursChoix']) < 1) {
			// 	print_r("<b style=\"color:green\">List parcoursChoix values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister['parcoursChoix']) . "<br>");
			// }
			// print_r("<br>");
			break;
		case 'parcoursText':
		case 'difficultesText':
		case 'autreInfoText':
			// print_r("<b>case</b> => <b>" . $key_value . "</b><br>");
			switch ($key_value) {
				case 'parcoursText':
					$titleValue = "parcours"; 
					break;
				case 'difficultesText':
					$titleValue = "difficultés"; 
					break;
				case 'autreInfoText':
					$titleValue = "autre information"; 
					break;
				default:
					break;
			}
			if (!empty($_POST[$key_value])) {
				$value = checkSendData($_POST[$key_value]);
				if (preg_match("/[^_#&`^@+%µ£¤§~°\<\>\$\=\|\{\}\[\]\\\*\/]{30,500}$/", $value)) {
					$listDatasToRegister[$key_value][] = $value;
				}
				else {
					if (strlen($value) < 30) {
						$listErrors[$key_value][] = "Le texte " . $titleValue . " doit contenir 30 caractères minimum !";
					}
					else if (strlen($value) > 500) {
						$listErrors[$key_value][] = "Le texte " . $titleValue . " doit contenir 500 caractères maximum !";
					}
					else {
						$listErrors[$key_value][] = "Le texte " . $titleValue . " contient des caractères non acceptés !";
					}
				}
			}
			else {
				switch ($titleValue) {
					case 'parcours':
						$listErrors[$key_value][] = "Veuillez indiquer votre " . $titleValue . " !";
						break;
					default:
						break;
				}
			}
			// if (!count($listErrors[$key_value]) < 1) {
			// 	print_r("<b style=\"color:red\">Erreurs difficultesText</b> => " . implode(",<br>\t\t    => ", $listErrors[$key_value]) . "<br>");
			// }
			// if (!count($listDatasToRegister[$key_value]) < 1) {
			// 	print_r("<b style=\"color:green\">List difficultesText values</b> => " . implode(",<br>\t\t        => ", $listDatasToRegister[$key_value]) . "<br>");
			// }
			// print_r("<br>");
			break;
		default:
			break;
	}
}

// print_r("<h1 style:\"color:blue\">Affichage listDatasToRegister</h1>");
// print_r($listDatasToRegister);
// print_r(count($listDatasToRegister));

/*
 * If all datas sended by user are good and not return errors. 
 * So the next step will be to send this datas stocked into the array $listDatasToRegister into the database.
 */
// $jsonlist = json_encode($listErrors);
// $jsonfile = fopen("./js/listErrors.json", "w+");
// fwrite($jsonfile, $jsonlist);
// fclose($jsonfile);
$listErrorsToDisplay = $listErrors;
foreach ($listErrors as $key => $value) {
	$listErrors[$key] = implode("", $value);
}
$listErrors = implode("", $listErrors);
if (strlen($listErrors) === 0 && !isset($checkSendData)) {
	$sql =$conn_pdo->prepare(
		'INSERT INTO sys_datas_form (
		sys_df_ref, 
		sys_df_create_date, 
		sys_df_how_you_know_us, 
		sys_df_hyku_precision, 
		sys_df_civility, 
		sys_df_lastname, 
		sys_df_firstname,
		sys_df_birthday, 
		sys_df_phone, 
		sys_df_email, 
		sys_df_driving_license, 
		sys_df_means_of_transport, 
		sys_df_status, 
		sys_df_accompaniment, 
		sys_df_accompaniment_precision,
		sys_df_step_text, 
		sys_df_qualifications, 
		sys_df_training_project, 
		sys_df_business_project, 
		sys_df_cfa_project, 
		sys_df_geographical_area,
		sys_df_steps,
		sys_df_accompaniment_step_choice,
		sys_df_difficulties_encountered,
		sys_df_other_info,
		sys_df_treat,
		sys_df_treat_date
		) VALUES (
		:ref, 
		:creatdate, 
		:howyouknowus, 
		:hykuprecision, 
		:civility, 
		:lastname, 
		:firstname,
		:birthday, 
		:phone, 
		:email, 
		:drivinglicense, 
		:meansoftransport, 
		:status, 
		:accompaniment, 
		:accompanimentprecision,
		:steptext, 
		:qualifications, 
		:trainingproject, 
		:businessproject, 
		:cfaproject, 
		:geographicalarea,
		:steps,
		:accompanimentstepchoice,
		:diffilcutiesencountered,
		:otherinfo,
		:treat,
		:treatdate
	)');

	$listColumnsTable = [
		":ref", 
		":creatdate", 
		":howyouknowus", 
		":hykuprecision", 
		":civility", 
		":lastname", 
		":firstname",
		":birthday", 
		":phone", 
		":email", 
		":drivinglicense", 
		":meansoftransport", 
		":status", 
		":accompaniment", 
		":accompanimentprecision",
		":steptext", 
		":qualifications", 
		":trainingproject", 
		":businessproject", 
		":cfaproject", 
		":geographicalarea",
		":steps",
		":accompanimentstepchoice",
		":diffilcutiesencountered",
		":otherinfo",
		":treat",
		":treatdate"
	];

	foreach ($listColumnsTable as $key => $columnValue) {
		switch ($columnValue) {
			case ':ref':
				$value = 'DTS'.mt_rand(100000,999999);
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':creatdate':
				$value = date('Y-m-d H:i:s');
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':howyouknowus':
				$value = $listDatasToRegister['connuComment'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':hykuprecision':
				if (count($listDatasToRegister['connuComment']) > 1) {
					$value = $listDatasToRegister['connuComment'][1];
					$predifinedConstant = PDO::PARAM_STR;
				}
				else {
					$value = NULL;
					$predifinedConstant = PDO::PARAM_NULL;
				}
				break;
			case ':civility':
				$value = $listDatasToRegister['coordonnees'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':lastname':
				$value = $listDatasToRegister['coordonnees'][1];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':firstname':
				$value = $listDatasToRegister['coordonnees'][2];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':birthday':
				$value = $listDatasToRegister['coordonnees'][3];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':phone':
				$value = $listDatasToRegister['coordonnees'][4];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':email':
				$value = $listDatasToRegister['coordonnees'][5];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':drivinglicense':
				$value = $listDatasToRegister['permis'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':meansoftransport':
				$value = $listDatasToRegister['moyenDeLocomotion'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':status':
				$value = $listDatasToRegister['statut'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':accompaniment':
				$value = $listDatasToRegister['accompagnement'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':accompanimentprecision':
				if (count($listDatasToRegister['accompagnement']) > 1) {
					$value = $listDatasToRegister['accompagnement'][1];
					$predifinedConstant = PDO::PARAM_STR;
				}
				else {
					$value = NULL;
					$predifinedConstant = PDO::PARAM_NULL;
				}
				break;
			case ':steptext':
				$value = $listDatasToRegister['parcoursText'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':qualifications':
				foreach ($listDatasToRegister['diplome'] as $qualificationKey => $qualificationValue) {
					if (is_array($qualificationValue)) {
						$listDatasToRegister['diplome'][$qualificationKey] = implode(" : ", $qualificationValue);
					}
				}
				$value = implode(";\r\n", $listDatasToRegister['diplome']);
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':trainingproject':
				$value = $listDatasToRegister['projet'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':businessproject':
				$value = $listDatasToRegister['projet'][1];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':cfaproject':
				$value = $listDatasToRegister['projet'][2];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':geographicalarea':
				if (count($listDatasToRegister['zoneGeographique']) > 1) {
					$value = implode(" : ", $listDatasToRegister['zoneGeographique']);
					$predifinedConstant = PDO::PARAM_STR;
				}
				else {
					$value = $listDatasToRegister['zoneGeographique'][0];
					$predifinedConstant = PDO::PARAM_STR;
				}
				break;
			case ':steps':
				foreach ($listDatasToRegister['demarches'] as $stepKey => $stepValue) {
					if (is_array($stepValue)) {
						$listDatasToRegister['demarches'][$stepKey] = implode(" : ", $stepValue);
					}
				}
				$value = implode(";\r\n", $listDatasToRegister['diplome']);
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':accompanimentstepchoice':
				$value = $listDatasToRegister['parcoursChoix'][0];
				$predifinedConstant = PDO::PARAM_STR;
				break;
			case ':diffilcutiesencountered':
				if (isset($listDatasToRegister['difficultesText'][0])) {
					$value = $listDatasToRegister['difficultesText'][0];
					$predifinedConstant = PDO::PARAM_STR;
				}
				else {
					$value = NULL;
					$predifinedConstant = PDO::PARAM_NULL;
				}
				break;
			case ':otherinfo':
				if (isset($listDatasToRegister['autreInfoText'][0])) {
					$value = $listDatasToRegister['autreInfoText'][0];
					$predifinedConstant = PDO::PARAM_STR;
				}
				else {
					$value = NULL;
					$predifinedConstant = PDO::PARAM_NULL;
				}
				break;
			case ':treat':
				$value = 0;
				$predifinedConstant = PDO::PARAM_INT;
				break;
			case ':treatdate':
				$value = NULL;
				$predifinedConstant = PDO::PARAM_NULL;
				break;
			default:
				break;
		}

		$sql->bindValue($columnValue, $value, $predifinedConstant);
	}

	$requete = $sql->execute();

	if ($requete === true) {
		// header("Location: index.php?#formulaire");
		$checkSendData = 1;
		$displaySuccessText = array(
			"<div class=\"divDisplaySuccess\">",
			"<h3>Le Formulaire a été envoyé avec succès !</h3>",
			"</div>"
		);
		//unset($sql, $listDatasToRegister, $_POST, $requete, $listErrors);
	}
	else {
		$displayFailedText = array(
			"<div class=\"divDisplayError\">",
			"<h3>Impossible d'envoyer le formulaire !</h3>",
			"</div>"
		);
	}
}
}
?>
</pre>
