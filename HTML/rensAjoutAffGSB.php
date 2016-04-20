<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensActModifGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="rensAjoutGSB.php">Retour</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a>
			<a href="index.html">Déconnexion</a>
			</p>
         </header>


<div class="bandeau-gauche">



<?php

	session_start();

$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	if($connexion){

		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");
		list($year, $month,$day )=split('[/.-]', $_POST['txtDateFrais']);
	/* ====TYPE VISITEUR==== */
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
		echo "<h1><br>Frais hors forfait:</h1>";
		
	if(isset($_POST['txtAutresFrais']) && isset($_POST['txtDateFrais']) && isset($_POST['txtMontantFrais'])){

		if($dateCourante< $_POST['txtDateFrais']  or $dateMois> $month){
			echo "<script>alert(\"La date n'est pas conforme\")</script>"; 
			
		}else{
			echo "<h2><br><br>Le frais a bien été ajouté</h2>";
		/* ====INSERTION LIGNE FRAIS HORS FORFAIT==== */
		$requete = 'insert into lignefraishorsforfait values
		("mysql_insert_id()",
		"'.$id.'",
		"'.$dateMois.'",
		"'.$_POST["txtAutresFrais"].'",
		"'.$_POST["txtDateFrais"].'",
		"'.$_POST["txtMontantFrais"].'")';//ok
	$resultat= $connexion->query($requete);

		

		

		echo "<table border =0>";
		echo "<tr><th>DATE</th><th>LIBELLE</th><th>MONTANT</th></tr>";
		echo "<tr><td>".$_POST['txtDateFrais']."</td><td>".$_POST['txtAutresFrais']."</td>
		<td>".$_POST['txtMontantFrais']." <td></tr>";
		echo "</table>";

		/* ====AJOUT JUSTIFICATIFS==== */
		$requete ='select nbJustificatifs
			from fichefrais
			where idVisiteur ="'.$id.'"
			and mois="'.$dateMois.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		$nbJust = $ligne['nbJustificatifs'];

		if($_POST['nom'] !=""){

			$nbJust = $nbJust+1;
			$requete ='update fichefrais
			set nbJustificatifs ="'.$nbJust.'"
			where mois ="'.$dateMois.'"
			and idVisiteur ="'.$id.'"';
			$resultat= $connexion->query($requete);

		}
		}
	}
	}else{
		echo "Pas de connexion!";
	}






?>



</div>
