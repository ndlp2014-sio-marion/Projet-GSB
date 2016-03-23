<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/renseignerFraisGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Suppression confirmée</title>
	
	
<body>
	 
		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a> 
			<a href ="accueilGSB.html">Déconnexion</a>
			
			</p>
          
		</header>

<div id="bienvenue">

	<h1>Suppression confirmée</h1>  

</div>


<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	if($connexion){
		mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		
		$requete = 'select typeVisiteur
					from visiteur
					where login ="'.$_SESSION['login'].'"
					and mdp ="'.$_SESSION['pass'].'"';
		$resultat =mysql_query($requete,$connexion);
		$ligne = mysql_fetch_assoc($resultat);
		$type = $ligne['typeVisiteur'];
		
		
		if($type =="visiteur"){
			echo "<div id='type'>Visiteur/ ".$login."</div>";
			
			
		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";
			//echo 'Bonjour'.$login;
		}
		echo "</div>";
		
		
		
		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);
?>


<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>