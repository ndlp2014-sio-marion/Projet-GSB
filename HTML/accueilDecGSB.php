<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/accueilGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>GSB</title>


<body>

<header>
            <p><a href="renseignerDecFraisGSB.php">Renseigner fiche frais</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a>
			<a href="index.html">Déconnexion</a>

			</p>

    </header>

<div class="bandeau-gauche">
<div id="bienvenue">

 <h1>Bienvenue sur GSB </h1>


	Le laboratoire Galaxy Swiss Bourdin est issu de la fusion entre le géant américain Galaxy (spécialisé dans le
	secteur des maladies virales
	dont le sida et les hépaties) et le conglomérat européen Swiss Bourdin (travaillant sur des médicaments plus conventionnels).
</div>



</TR>
<td></br></br></br></br></br></td>
<?php

	session_start();
	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	if($connexion){

		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];

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
		echo "</div>";



		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}

	
?>





<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>
</div>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
