<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/consulterDecFraisGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Consulter frais</title>


<body>

		<header>
            <p>
			<a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href="index.html">Déconnexion</a>
			</p>

		</header>
 <div class="bandeau-gauche">


<?php

	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
//	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	//$connexion = mysql_connect("localhost","root","");
	if($connexion){
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$dateCourante = date("Y-m-d");

$resultat =$connexion->query("select typeVisiteur from visiteur");

		/* ====TYPE VISITEUR==== */
		$requete = 'select typeVisiteur
					from visiteur
					where login ="'.$_SESSION['login'].'"
					and mdp ="'.$_SESSION['pass'].'"';
		$resultat= $connexion->query($requete);
	//$resultat =mysql_query($requete,$connexion);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
	//	$ligne = mysql_fetch_assoc($resultat);

		$type = $ligne['typeVisiteur'];


		if($type =="visiteur"){
			echo "<div id='type'>Visiteur/ ".$login."</div>";


		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";

		}
		echo "<h1><br>Consulter frais</h1>";



		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}
	$resultat->closeCursor();
	//$connexion = null;
	//mysql_close($connexion);
?>
<div id="mois">
<form action = "consulterActGSB.php" method="post">
Choisir le mois du frais:
	<select name="lst_mois">
<option selected value=1>Janvier</option>
<option value=2>Février</option>
<option value=3>Mars</option>
<option value=4>Avril</option>
<option value=5>Mai</option>
<option value=6>Juin</option>
<option value=7>Juillet</option>
<option value=8>Aout</option>
<option value=9>Septembre</option>
<option value=10>Octobre</option>
<option value=11>Novembre</option>
<option value=12>Décembre</option>
</select>

<INPUT type="submit" value="Valider" class="submit">

</form>
</div>



<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->

</body>


 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
