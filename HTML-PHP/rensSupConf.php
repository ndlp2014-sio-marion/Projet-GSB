<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/renseignerFraisGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>
	
	
<body>
	 
		<header>
            <p><a href="accueilDecGSB.html">Accueil</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a> 
			<a href="rensAjoutGSB.php">Ajout</a>
			<a href="rensModifGSB.php">Modification</a>
			<a href="rensSuppressionGSB.php">Suppression</a>
			<a href ="accueilGSB.html">Déconnexion</a>
			
			</p>
          
		</header>

<div id="bienvenue">

	<h1>Renseigner fiche frais</h1>  

</div>
<form action = "renseignerActGSB.php" method="post">
<table border=0>

<div id="mois">
	<tr><td><h2>Frais forfaitaires:<h2> </td></tr>
	<tr><td>Forfait étape: </td><td><input type=text name="txtForfaitEtape"></td></tr>
	<tr><td>Frais kilomètriques: </td><td><input type=text name="txtForfaitKilo"></td></tr>
	<tr><td>Nuitée hôtel: </td><td><input type=text name="txtNuit>"></td></tr>
	<tr><td><h2>Autres frais:</h2></td></tr>
	<tr><td>Date frais: </td><td><input type=date name="txtDateFrais"></td>
	<td>Intitulé: </td><td><input type=text name="txtAutreFrais"></td>
	<td>Montant: </td><td><input type=text name="txtMontant"></td></tr>
	<tr><td></td>
	<td>Frais au forfait<INPUT TYPE="radio" NAME="opt_forfait" VALUE="forfait">
	Frais hors forfait<INPUT TYPE="radio" NAME="opt_forfait" VALUE="horsforfait"></td></tr>
	
	
	<tr><td><INPUT type="submit" value="Valider" class="submit"></td><td><INPUT type="reset" value="Réinitialiser"></td></tr>
	
	
<table>
</form>

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
		
		//echo $type."Bonjour";
		
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