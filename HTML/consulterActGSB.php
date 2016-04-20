<html>
<head>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/consulterFraisGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Consultation des frais</title>

</head>
<body>

		<header>
			<p>
			<a href="accueilDecGSB.php">Accueil</a>
			<a href="consulterDecFraisGSB.php">Retour</a>
			<a href="index.html">Déconnexion</a>
			</p>
        </header>



<div class="bandeau-gauche">

<?php

	session_start();
	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");

	if($connexion){
		//mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");
		$dateJour = date("d");

		$requete = 'select typeVisiteur
					from visiteur
					where login ="'.$_SESSION['login'].'"
					and mdp ="'.$_SESSION['pass'].'"';
					$resultat= $connexion->query($requete);

					$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		$type = $ligne['typeVisiteur'];


		if($type =="visiteur"){
			echo "<div id='type'>Visiteur/ ".$login."</div>";


		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";

		}
		$requete = 'select sum(quantite) as nb
		from lignefraisforfait
		where idVisiteur = "'.$id.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		$montant = $ligne['nb'];

		$requete ='update fichefrais set montantValide = "'.$montant.'"
		where idVisiteur ="'.$id.'"
		and "'.$dateMois.'"';
		$resultat= $connexion->query($requete);

		/* ====CONSULTATION FRAIS==== */
		echo "<h1><br>Consultation des frais:</h1>";
		$requete = 'select visiteur.id,mois,nbJustificatifs,montantValide,dateModif,idEtat, nom
					from fichefrais, visiteur
					where fichefrais.idVisiteur =visiteur.id
						and visiteur.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp="'.$pass.'"
											)
						and mois = "'.$_POST['lst_mois'].'"';
						$resultat= $connexion->query($requete);
						$ligne =$resultat->fetch(PDO::FETCH_ASSOC);




		echo "<div id='consulterAct'>";
		echo "<table border =0>";
		echo "<h2>Fiche de frais:</h2>";
		echo "<tr><th>NOM</th><th>MOIS</th><th>JUSTIFICATIFS</th><th>MONTANT VALIDE</th><th>DATE</th><th>Etat</th></tr>";

		/* ====CONVERSION DU MOIS EN CHAINE==== */
		$mois="";
		if($ligne['mois']==1){
			$mois = "Janvier";
		}else if($ligne['mois']==2){
			$mois = "Février";
		}
		else if($ligne['mois']==3){
			$mois = "Mars";
		}
		else if($ligne['mois']==4){
			$mois = "Avril";
		}
		else if($ligne['mois']==5){
			$mois = "Mai";
		}
		else if($ligne['mois']==6){
			$mois = "Juin";
		}
		else if($ligne['mois']==7){
			$mois = "Juillet";
		}
		else if($ligne['mois']==8){
			$mois = "Aout";
		}
		else if($ligne['mois']==9){
			$mois = "Septembre";
		}
		else if($ligne['mois']==10){
			$mois = "Octobre";
		}
		else if($ligne['mois']==11){
			$mois = "Novembre";
		}
		else if($ligne['mois']==12){
			$mois = "Décembre";
		}

		/* ====ETAT==== */
		$idEtat = "";
		while($ligne){
			if($ligne['idEtat'] == "CL"){
				$idEtat = "Saisie en cours";

			}
			else if($ligne['idEtat'] == "CR"){
				$idEtat = "Fiche crée, saisie en cours";
			}
			else if($ligne['idEtat'] == "RB"){
				$idEtat = "Remboursée";
			}
			else if($ligne['idEtat'] == "VA"){
				$idEtat = "Validée et mise en paiement";
			}
			echo"<tr><td>".$ligne['nom']."</td><td>".$mois."</td>
			<td>".$ligne['nbJustificatifs']."</td><td>".$ligne['montantValide']."</td><td>".$ligne['dateModif']."</td><td>".$idEtat."</td></tr>";
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
		echo "</table>";

		/* ====FRAIS HORS FORFAIT==== */
		$requete = 'select mois,libelle,dateHF,montant,nom
					from lignefraishorsforfait, visiteur
					where lignefraishorsforfait.idVisiteur =visiteur.id
						and visiteur.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp="'.$pass.'"
											)
						and mois = "'.$_POST['lst_mois'].'"';
						$resultat= $connexion->query($requete);

		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		echo"<br>";
		echo "<table border =0>";
		echo "<h2>Frais hors forfait:</h2>";
		echo "<tr><th>NOM</th><th>MOIS</th><th>LIBELLE</th><th>DATE</th><th>MONTANT</th></tr>";


		while($ligne){
			echo"<tr><td>".$ligne['nom']."</td><td>".$mois."</td>
			<td>".$ligne['libelle']."</td><td>".$ligne['dateHF']."</td><td>".$ligne['montant']."</td></tr>";
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		}



		echo "</table>";

		/* ====DETAIL FICHE DE FRAIS==== */
		$requete ='select mois,idFraisForfait,quantite
		from lignefraisforfait
		where idVisiteur ="'.$id.'"
		and mois= "'.$_POST['lst_mois'].'"
		';
		$resultat= $connexion->query($requete);

		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		echo "<h2>Détail fiche de frais:</h2>";
		echo '<table border=0>';
		echo '<tr><th>NOM</th><th>MOIS</th><th>FRAIS</th><th>MONTANT</th></tr>';

		while($ligne){

			if($_POST['lst_mois'] ==1){
				$dateModif ="Janvier";

			}
			else if($_POST['lst_mois'] == 2){
				$dateModif ="Février";
			}
			else if($_POST['lst_mois'] == 3){
				$dateModif ="Mars";
			}
			else if($_POST['lst_mois'] ==4){
				$dateModif ="Avril";
			}
			else if($_POST['lst_mois'] == 5){
				$dateModif ="Mai";
			}

			else if($_POST['lst_mois'] == 6){
				$dateModif ="Juin";
			}

			else if($_POST['lst_mois'] == 7){
				$dateModif ="Juillet";
			}

			else if($_POST['lst_mois'] == 8){
				$dateModif ="Aout";
			}


			else if($_POST['lst_mois'] == 9){
				$dateModif ="Septembre";
			}

			else if($_POST['lst_mois'] == 10){
				$dateModif ="Octobre";
			}

			else if($_POST['lst_mois'] == 11){
				$dateModif ="Novembre";
			}


			else if($_POST['lst_mois'] == 12){
				$dateModif ="Décembre";
			}
			$idFrais= "";
			if($ligne['idFraisForfait'] == "ETP" ){
				$idFrais ="Etape";
			} else if($ligne['idFraisForfait'] == "REP" ){
				$idFrais ="Repas";
			}
			else if($ligne['idFraisForfait'] == "KM"){
				$idFrais ="Kilomètre";
			}
			else if($ligne['idFraisForfait'] == "NUI"){
				$idFrais ="Nuitée";
			}

			echo '<tr><td>'.$login.'</td><td>'.$dateModif.'</td><td>'.$idFrais.'</td><td>'.$ligne['quantite'].'</td></tr>';
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
			//$resultat->closeCursor();
		}
		echo "</div>";

	}else{
		echo "Pas de connexion!";
	}


?>

<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->
</div>



</body>


 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>


</html>
