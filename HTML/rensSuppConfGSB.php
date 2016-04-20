<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensSuppressionGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href ="index.html">Déconnexion</a>

			</p>

		</header>
<div class="bandeau-gauche">
<div id="renseigner">
<form action = "rensConfirmeGSB.php" method="post">

	<table border=0>

	<tr><td><INPUT type="submit" value="Confirmer" class="submit"></td></td>
		<td><a href="rensSuppressionGSB.php">Annuler</a><td></tr>

	</table>
</form>

</div>

<?php


	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	if($connexion){
		session_start();
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];

		if(isset($_POST['lst_frais'])){
			$_SESSION['libfrais'] = $_POST['lst_frais'];

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
			echo "<h1><br>Suppression frais</h1>";

		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";
			echo "<h1><br>Suppression frais</h1>";
			echo "<h2>Confirmer la suppression du frais: ".$_SESSION['libfrais']."</h2>";
		}


		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}


		}

?>

</div>
<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
