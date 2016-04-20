<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/renseignerDecFraisGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>
	
	
<body>
	 
		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a> 
			<a href="rensAjoutGSB.php">Ajout</a>
			<a href="rensModifGSB.php">Modification</a>
			<a href="rensSuppressionGSB.php">Suppression</a>
			<a href ="index.html">Déconnexion</a>
			
			</p>
          
		</header>
		

<div class="bandeau-gauche">

<script language = "javascript" type="text/javascript">

function verif_formulaire(){

	
 if(isNaN(document.frmFormulaire.txtForfaitEtape.value))  {
    // sinon on affiche un message
    alert("Le champ Forfait étape requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitEtape.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtForfaitKilo.value))  {
    // sinon on affiche un message
    alert("Le champ Forfait kilomètre requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtNuit.value))  {
    // sinon on affiche un message
    alert("Le champ Nuitée hôtel requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtMontant.value))  {
    // sinon on affiche un message
    alert("Le champ Montant requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  
 }
</script>

	<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	 $connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	if($connexion){
		mysql_select_db("gsbv3");
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
			
			
			
		}else{
			echo "<div id='type'>Comptable/ ".$login."</div>";
			
			
		}
		echo "<h1><br>Renseigner frais</h1>";
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");
		
		
		/* =============IMPORTANT===================*/
		
		$requete = 'select mois
		from ficheFrais
		where idVisiteur ="'.$id.'"
		and mois = "'.$dateMois.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		if($ligne){
			echo "<h2>La fiche a déjà été saisie, veuillez modifier les frais si vous le souhaitez</h2>";
			echo "";
		}else{
			
			echo '<div id="rensDec">';
			echo '<form name="frmFormulaire" action = "renseignerActGSB.php" method="post" onSubmit="return verif_formulaire()">';


			echo '<table border=0>';



	echo '<tr><td><h2>Frais forfaitaires:</h2> </td></tr>';
	echo '<tr><td>Forfait étape: </td><td><input type=text name="txtForfaitEtape" required="required"></td></tr>';
	echo '<tr><td>Frais kilomètriques: </td><td><input type=text name="txtForfaitKilo" required="required"></td></tr>';
	echo '<tr><td>Nuitée hôtel: </td><td><input type=text name="txtForfaitNuit" required="required"></td></tr>';
	echo '<tr><td>Repas restaurant: </td><td><input type=text name="txtForfaitRep" required="required"></td></tr>';
	echo '</table>';
	echo '<table border=0>';
	
	
	
	echo '<tr><td><INPUT type="submit" value="Valider" class="submit"></td><td><INPUT type="reset" value="Réinitialiser" class="reset"></td></tr>';
	
	
	echo '</table>';
	echo '</form>';
	echo '</div>';
		}
		
		
	}else{
		echo "Pas de connexion!";
	}
	
	//mysql_close($connexion);
?>





<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->

</div>
</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>