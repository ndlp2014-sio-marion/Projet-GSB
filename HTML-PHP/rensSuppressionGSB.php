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

echo '</form>';
error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	$nb =0;
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
		
			
			
		$requete ='select libelle
				from fraishorsforfait;';
		$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		echo "<div id='listLib'>";
		echo "<table border=0>";
		echo "<select name='frais'>";
		while($ligne){
			echo "<tr><option value=".$ligne['libelle'].">". $ligne['libelle']
			. "</tr>";
			//boucle infini
			$ligne = mysql_fetch_assoc($resultat);
		}
		
		echo "</select>";
		echo "</table>";
		//$requete ='delete from fraishorsforfait where libelle ="'.$ligne['libelle'].'"';
		
		echo "<form action ='rensSuppConfGSB.php' method='POST'>";
		echo "<table border=0>";

		


		echo "<tr><td><INPUT type='submit' value='Valider' class='submit'></td>";
		echo "<td><INPUT type='reset' value='Réinitialiser' class='reset'></td></tr>";
		
	
echo "</table>";
		echo "</div>";
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);




?>

</div>


<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>