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
			<a href="rensAjoutGSB.php">Ajout</a>
			<a href="rensModifGSB.php">Modification</a>
			<a href="rensSuppressionGSB.php">Suppression</a>
			<a href ="accueilGSB.html">Déconnexion</a>
			
			</p>
          
		</header>
<div class="bandeau-gauche">

<script language = "javascript" type="text/javascript">

function verif_formulaire(){
// si la valeur du champ prenom est vide
	
 if(isNaN(document.frmFormulaire.txtForfaitEtape.value) == true)  {
    // sinon on affiche un message
    alert("Le champ Forfait étape requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitEtape.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtForfaitKilo.value) == true)  {
    // sinon on affiche un message
    alert("Le champ Forfait kilomètre requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtNuit.value) == true)  {
    // sinon on affiche un message
    alert("Le champ Nuitée hôtel requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  else if(isNaN(document.frmFormulaire.txtMontant.value) == true)  {
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
		
		/* =====DATE COURANTE===== */
		$dateCourante = date("d-m-Y");
		//echo "date courante = ".$dateCourante;
		$dateMois = date("m");
		//echo "date courante = ".$dateMois;
		
		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);
?>
<div id="rensDec">
<form name="frmFormulaire" action = "renseignerActGSB.php" method="post" onSubmit="return verif_formulaire()">


<table border=0>

<!--faire en deux tableau-->

	<tr><td><h2>Frais forfaitaires:<h2> </td></tr>
	<tr><td>Forfait étape: </td><td><input type=text name="txtForfaitEtape" required="required"></td></tr>
	<tr><td>Frais kilomètriques: </td><td><input type=text name="txtForfaitKilo" required="required"></td></tr>
	<tr><td>Nuitée hôtel: </td><td><input type=text name="txtNuit>" required="required"></td></tr>
	<tr><td>Repas restaurant: </td><td><input type=text name="txtForfaitRep>" required="required"></td></tr>
	</table>
	<table border=0>
	<tr><td><h2>Autres frais:</h2></td></tr>
	<tr><td>Date frais: </td><td><input type=date name="txtDateFrais" required="required"></td>
	<td>Intitulé: </td><td><input type=text name="txtAutreFrais" required="required"></td>
	<td>Montant: </td><td><input type=text name="txtMontant" required="required"></td></tr>
	<tr><td></td>
	<!--a enlever -->
	<td>Frais au forfait<INPUT TYPE="radio" NAME="opt_forfait" VALUE="forfait">
	Frais hors forfait<INPUT TYPE="radio" NAME="opt_forfait" VALUE="horsforfait"></td></tr>
	
	
	<tr><td><INPUT type="submit" value="Valider" class="submit"></td><td><INPUT type="reset" value="Réinitialiser" class="reset"></td></tr>
	
	
</table>
</form>
</div>




<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->

</div>
</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>