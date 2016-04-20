<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensModifGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a>
			<a href="index.html">Déconnexion</a>
			</p>
         </header>
    <div class="bandeau-gauche">


<?php

	session_start();
	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	$i=0;
	if($connexion){
		//mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		$lst_frais = $_SESSION['lst_frais'];
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");

		/* ====TYPE VISITEUR====*/
		$requete = 'select typeVisiteur
					from visiteur
					where login ="'.$_SESSION['login'].'"
					and mdp ="'.$_SESSION['pass'].'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		$type = $ligne['typeVisiteur'];

		if($type =="visiteur"){
			echo "<div id='type'>Visiteur/ ".$login."</div>";
			echo "<h1><br>Affichage renseignement</h1>";


		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";
			echo "<h1><br>Affichage renseignement</h1>";

		}

		/* ====MODIFICATION quantite LIGNE FRAIS FORFAIT==== */

		if($lst_frais =="Nuitée/"){
			$requete = 'update lignefraisforfait
			set quantite ="'.$_POST['txtMontant'].'"
			where idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"
			and idFraisForfait ="NUI"';
		$resultat= $connexion->query($requete);

		/* ====AFFICHAGE VALEUR MODIFIEE==== */
		$requete ='select mois,idFraisForfait,quantite from lignefraisforfait
		where idFraisForfait ="NUI"
		and idvisiteur = "'.$id.'"
		and mois = "'.$dateMois.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		//$ligne = mysql_fetch_assoc($resultat);
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';
		echo '<tr><td>Nuitée</td><td>'.$ligne['quantite'].'</td><td>'.$ligne['mois'].'</td></tr>';
		echo "</table>";

		}else if($lst_frais =="Repas/"){
			$requete = 'update lignefraisforfait
			set quantite ="'.$_POST['txtMontant'].'"
			where idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"
			and idFraisForfait ="REP"';
		$resultat= $connexion->query($requete);

		/* ====AFFICHAGE VALEUR MODIFIEE==== */
		$requete ='select mois,idFraisForfait,quantite from lignefraisforfait
		where idFraisForfait ="REP"
			and idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		//$ligne = mysql_fetch_assoc($resultat);
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';
		echo '<tr><td>Repas</td><td>'.$ligne['quantite'].'</td><td>'.$ligne['mois'].'</td></tr>';
		echo "</table>";

		}else if($lst_frais =="Kilomètre/"){
			$requete = 'update lignefraisforfait
			set quantite ="'.$_POST['txtMontant'].'"
			where idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"
			and idFraisForfait ="KM"';
		$resultat= $connexion->query($requete);

		/* ====AFFICHAGE VALEUR MODIFIEE==== */
		$requete ='select mois,idFraisForfait,quantite
		from lignefraisforfait
		where idFraisForfait ="KM"
			and idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"';
		//and visiteur = and ...
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';
		echo '<tr><td>Kilomètre</td><td>'.$ligne['quantite'].'</td><td>'.$ligne['mois'].'</td></tr>';
		echo "</table>";
		}
		else if($lst_frais =="Etape/"){
			$requete = 'update lignefraisforfait
			set quantite ="'.$_POST['txtMontant'].'"
			where idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"
			and idFraisForfait ="ETP"';
		$resultat= $connexion->query($requete);

		/* ====AFFICHAGE VALEUR MODIFIEE==== */
		$requete ='select mois,idFraisForfait,quantite from lignefraisforfait
		where idFraisForfait ="ETP"
		and mois = "'.$dateMois.'"
		and idVisiteur ="'.$id.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		//$ligne = mysql_fetch_assoc($resultat);
		$dateModif ="";
		if($dateMois ==1){
				$dateModif ="Janvier";

			}
			else if($dateMois == 2){
				$dateModif ="Février";
			}
			else if($dateMois == 3){
				$dateModif ="Mars";
			}
			else if($dateMois==4){
				$dateModif ="Avril";
			}
			else if($dateMois == 5){
				$dateModif ="Mai";
			}

			else if($dateMois == 6){
				$dateModif ="Juin";
			}

			else if($dateMois == 7){
				$dateModif ="Juillet";
			}

			else if($dateMois == 8){
				$dateModif ="Aout";
			}


			else if($dateMois == 9){
				$dateModif ="Septembre";
			}

			else if($dateMois == 10){
				$dateModif ="Octobre";
			}

			else if($dateMois == 11){
				$dateModif ="Novembre";
			}


			else if($dateMois == 12){
				$dateModif ="Décembre";
			}
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';
		echo '<tr><td>Etape</td><td>'.$ligne['quantite'].'</td><td>'.$dateModif.'</td></tr>';
		echo "</table>";

		}
		/*$requete = 'update lignefraisforfait
			set quantite ="'.$_POST['txtMontant'].'"
			where idvisiteur = "'.$id.'"
			and mois = "'.$dateMois.'"
			and idFraisForfait ="'.$lst_frais.'"';
		$resultat= mysql_query($requete,$connexion);
		*/
		/* ====AFFICHAGE VALEUR MODIFIEE==== */
		/*$requete ='select mois,idFraisForfait,quantite from lignefraisforfait
		where idFraisForfait ="'.$lst_frais.'" ';
		$resultat =mysql_query($requete,$connexion);
		$ligne = mysql_fetch_assoc($resultat);
		//$ligne = mysql_fetch_assoc($resultat);
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';
		echo '<tr><td>'.$ligne['idFraisForfait'].'</td><td>'.$ligne['quantite'].'</td><td>'.$ligne['mois'].'</td></tr>';
		echo "</table>";*/


	}else{
		echo "Pas de connexion!";
	}

	//mysql_close($connexion);
?>


<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->
</div>

</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
