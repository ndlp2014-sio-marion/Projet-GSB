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
<script language = "javascript" type="text/javascript">

function verif_formulaire(){
	var regex = new RegexExp(/([^A-Za-z0-9\-])/);
// si la valeur du champ prenom est vide

  if(isNaN(document.frmFormulaire.txtMontantFrais.value) == true)  {
    // sinon on affiche un message
    alert("Le champ Montant requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtForfaitKilo.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
  
  else if(regex.test(document.frmFormulaire.txtAutresFrais.value)){
	  
	  alert("Le champ Montant requière une chaine!");
	  return false;
  }
	
 }

 </script>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	$nb =0;
	if($connexion){
		mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		
		if(isset($_POST['txtAutresFrais']) &&isset($_POST['txtDateFrais']) &&isset($_POST['txtMontantFrais'])){
			
			$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		$requete = 'insert into autresFrais values
		("'.$_POST["'.txtDateFrais.'"].'","'.$_POST["'.txtAutresFrais.'"].'",
		"'.$_POST["'.txtMontantFrais.'"].'")';
		
		$requete = 'insert into fraisHorsforfait values
		("'.$_POST["'.txtDateFrais.'"].'","'.$_POST["'.txtAutresFrais.'"].'",
		"'.$_POST["'.txtMontantFrais.'"].'")';
		
		$requete = 'insert into lignefraishorsforfait values
		("'.$_POST["'.txtDateFrais.'"].'","'.$_POST["'.id.'"].'",
		"'.$_POST["'.id.'"].'",
		"'.$_POST["'.txtAutresFrais.'"].'",
		"'.$_POST["'.txtDateFrais.'"].'",
		"'.$_POST["'.txtMontant.'"].'")';
		
		echo header('Location:renseignerDecFraisGSB.php') ; 
		}
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
		
		
		
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);




?>
 <div id="mois">
<form name = "frmFormulaire" action="rensAjoutGSB.php" method="post" onSubmit="return verif_formulaire()">
<table border=0>



	<tr><td>Date engagement: </td><td><input type=date name="txtDateFrais" required="required"></td>
	<tr><td>Libellé: </td><td><input type=text name="txtAutresFrais" required="required"></td></tr>
	<tr><td>Montant: </td><td><input type=text name="txtMontantFrais" required="required"></td></tr>

	
	
	<tr><td><INPUT type="submit" value="Valider" class="submit"></td>
	<td><INPUT type="reset" value="Réinitialiser" class="reset"></td></tr>
	
	
</table>
</form>

</div>




</div>


<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>