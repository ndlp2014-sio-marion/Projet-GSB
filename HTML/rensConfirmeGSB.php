<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensSuppressionGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Suppression confirmée</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="rensSuppressionGSB.php">Suppression Frais</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href="ConsulterDecFraisGSB.php">Consulter frais</a>
			<a href ="index.html">Déconnexion</a>

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
		$libfrais = $_SESSION['libfrais'];

		/* ====TYPE VISITEUR==== */
		$requete = 'select typeVisiteur
					from visiteur
					where login ="'.$_SESSION['login'].'"
					and mdp ="'.$_SESSION['pass'].'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		$type = $ligne['typeVisiteur'];


		if($type =="visiteur"){
			echo '<div id="type">Visiteur/ '.$login.'</div>';

		}else{
			echo '<div id="type">Comptable/ '.$login.'</div>';

		}

		$requete ='delete from lignefraishorsforfait where libelle like "'.$libfrais.'%" limit 1';
		$resultat= $connexion->query($requete);
		if ($resultat) {

			echo "<h1><br>Frais supprimé</h1>";
		} else {
			echo "<h1><br>Frais non supprimé</h1>";
		}

		echo "<h1>".$libfrais."</h1>";



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
