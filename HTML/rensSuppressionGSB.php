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
			echo "<h1><br>Suppression frais</h1>";


		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";
			echo "<h1><br>Suppression frais</h1>";

		}




		$requete ='select libelle
				from lignefraishorsforfait
				where idVisiteur="'.$id.'";';
				$resultat= $connexion->query($requete);

				$ligne =$resultat->fetch(PDO::FETCH_ASSOC);


		if(!$ligne){

			echo"<h1>Pas de frais</h1>";
		}else{

			echo "<div id='listLib'>";
		//echo "<table border=0>";


		//echo "</table>";
		//$requete ='delete from fraishorsforfait where libelle ="'.$ligne['libelle'].'"';

		echo '<form action ="rensSuppConfGSB.php" method="POST">';
		echo '<select name="lst_frais">';
		echo '<option selected ="selected" value='.$ligne['libelle'].'>'.$ligne['libelle'].'</option>';
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		while($ligne){
			echo '<option  selected ="selected" value='.$ligne['libelle'].'>'.$ligne['libelle'].'</option>';

			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}

		echo '</select>';
		echo '<table border=0>';



		echo '<tr><td><INPUT type="submit" value="Valider" class="submit"></tr>';



		echo '</table>';
		echo '</form>';echo '</div>';

	}
	}else{
		echo "Pas de connexion!";
	}

	//mysql_close($connexion);






?>

</div>


<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
