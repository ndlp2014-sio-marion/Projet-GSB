<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensAjoutGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Renseigner frais</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a>
			<a href="index.html">Déconnexion</a>
			</p>
         </header>


<div class="bandeau-gauche">
<script language = "javascript" type="text/javascript">

function verif_formulaire(){
	

  if(isNaN(document.frmFormulaire.txtMontantFrais.value))  {
    // sinon on affiche un message
    alert("Le champ Montant requière un nombre!");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtMontantFrais.focus();
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

	session_start();

	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	echo '<h1><br>Ajout d\'un frais hors forfait</h1>';
	if($connexion){

		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");
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

		/*if(isset($_POST['txtAutresFrais']) &&isset($_POST['txtDateFrais']) &&isset($_POST['txtMontantFrais'])){
		/* ====INSERTION LIGNE FRAIS HORS FORFAIT==== */
	/*	$requete = 'insert into lignefraishorsforfait values
		("mysql_insert_id()",
		"'.$id.'",
		"'.$dateMois.'",
		"'.$_POST["txtAutresFrais"].'",
		"'.$_POST["txtDateFrais"].'",
		"'.$_POST["txtMontantFrais"].'")';//ok*/
		
		
		/*echo "<h1><br>Ajout d'un frais hors forfait</h1>";

		}*/

	}else{
		echo "Pas de connexion!";
	}






?>
 <div id="moisAj">
<form name = "frmFormulaire" action="rensAjoutAffGSB.php" method="post" onSubmit="return verif_formulaire()">
<table border=0>



	<tr><td>Date engagement: </td><td><input type=date name="txtDateFrais" required="required"></td></tr>
	<tr><td>Libellé: </td><td><input type=text name="txtAutresFrais" required="required"></td></tr>
	<tr><td>Montant: </td><td><input type=text name="txtMontantFrais" required="required"></td></tr>


	<tr><td>Justificatifs:<INPUT TYPE="hidden" NAME="MAX_FILE_SIZE" class ="piece" ></td>
	<td><INPUT TYPE="file" NAME="nom" class ="piece"></td></tr>
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
