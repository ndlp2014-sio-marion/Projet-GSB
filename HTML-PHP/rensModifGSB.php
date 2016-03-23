<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/renseignerFraisGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>
	
	
<body>
	 
		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a> 
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href="accueilGSB.html">Déconnexion</a>
			</p>
         </header>
    <div class="bandeau-gauche">


<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	$i=0;
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
			echo "<div id='type'>Comptable</div>";
			//echo 'Bonjour'.$login;
		}
		
		
		$requete = 'select libelle,montant, fraisforfait.id
		from lignefraisforfait,fraisforfait
		where lignefraisforfait.idfraisforfait = fraisforfait.id';
		
		$ligne = mysql_fetch_assoc($resultat);
		$libelle = $ligne['libelle'];
		$montant = $ligne['montant'];
		$idFrais = $ligne['fraisforfait.id'];
		echo '<div id="rensModif">';
		echo '<select name="lst_frais">';
		while($ligne){
			echo '<option selected value='.$idFrais.'>'.$libelle.'/'.$montant.'</option>';
			$ligne = mysql_fetch_assoc($resultat);
		}
		
		echo '<form action = "rensActModifGSB.php" method="post">';
		echo '<table border=0>';
		echo '<tr><td><INPUT type="submit" value="Valider" class="submit">
		</td></tr>';
		echo '</table>';
		echo '</form>';
		
		echo '</select>';
		
		echo '</div>';
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



</html>