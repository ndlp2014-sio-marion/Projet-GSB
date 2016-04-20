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

	if($connexion){

		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];


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
		echo "<h1><br>Modification renseignement</h1>";



		$requete ='select idFraisForfait,mois from lignefraisforfait
		where idVisiteur = "'.$id.'"
		order by mois';
		$resultat= $connexion->query($requete);

		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);



		/* ====CONVERSION DU MOIS==== */
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
		echo '<div id="rensModif">';

		/* ====AFFICHAGE DE LA LISTE DE FRAIS==== */
		echo '<form action = "rensActModifGSB.php" method="post">';
		echo '<select name="lst_frais">';
		while($ligne){
			$idFrais ="";
		if($ligne['idFraisForfait'] == "ETP"){
			$idFrais ="Etape";
		}
		else if($ligne['idFraisForfait'] == "NUI"){
			$idFrais = "Nuitée";
		}
		else if($ligne['idFraisForfait'] == "REP"){
			$idFrais = "Repas";
		}
		else if($ligne['idFraisForfait'] == "KM"){
			$idFrais = "Kilomètre";
		}
			$cle =$idFrais."/ ".$mois."/ ".$login;

			echo '<option value='.$cle.'>'.$cle.'</option>';
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
		//$_SESSION['lst_frais'] = $idFrais;
		echo '<table border=0>';
		echo '<tr><td><INPUT type="submit" value="Valider" class="submit">
		</td></tr>';
		echo '</table>';


		echo '</select>';
		echo '</form>';


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
