<html>
<head>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/consulterFraisGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Consulter frais</title>
	
</head>
<body>

		<header>
			<p>
			<a href="accueilDecGSB.php">Accueil</a>
			<a href="accueilGSB.html">Déconnexion</a>
			</p>
        </header>
    


<div class="bandeau-gauche">

<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	if($connexion){
		mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
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
		$requete = 'select dateModif,idEtat,visiteur.id,mois,montantValide,nbJustificatifs
					from fichefrais, visiteur
					where fichefrais.idVisiteur =visiteur.id
						and visiteur.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp="'.$pass.'"
											)
						and mois = "'.$_POST['lst_mois'].'"';
		$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		echo "<div id='consulterAct'>";
		echo "<table border =0>";
		echo "<tr><th>MOIS</th><th>MONTANT VALIDE</th><th>NB JUSTIFICATIFS</th></tr>";
		
		
		while($ligne){
			echo"<tr><td>".$ligne['mois']."</td><td>".$ligne['montantValide']."</td>
			<td>".$ligne['nbJustificatifs']."</td></tr>";
			$ligne = mysql_fetch_assoc($resultat);
		}
		
	
		
		
		//echo $type."Bonjour";
		
		echo "</table>";
		echo "</div>";
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);
?>

<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->

</div>
</body>


 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>

</body>
</html>