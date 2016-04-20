<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/rensActModifGSB.css" />
<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>


<body>

		<header>
            <p><a href="accueilDecGSB.php">Accueil</a>
			<a href="rensModifGSB.php">Retour</a>
			<a href="consulterDecFraisGSB.php">Consulter fiche de frais</a>
			<a href="index.html">Déconnexion</a>
			</p>
         </header>


<script language = "javascript" type="text/javascript">

function verif_formulaire(){
// si la valeur du champ prenom est vide
 if(document.frmFormulaire.txtMontant.value == "")  {
    // sinon on affiche un message
    alert("Saisissez le libelle");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtMontant.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
 }
</script>

 <div class="bandeau-gauche">
<?php

	session_start();
	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	$i=0;
	if($connexion){

		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		//$lst_frais=$_SESSION['lst_frais'];
		$_SESSION['lst_frais'] = $_POST['lst_frais'];
		$lst_frais = $_SESSION['lst_frais'];

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
			echo "<div id='type'>Comptable/".$login."</div>";
			/*echo "<h1>".$_SESSION['lst_frais']."</h1>";*/
		}
		echo "<h1><br>Renseigner frais</h1>";




		$requete = 'select mois,quantite, idFraisForfait
		from lignefraisforfait
		where idvisiteur="'.$id.'"
		and mois ="'.$dateMois.'"';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);



		/* ====CONVERSION DU MOIS==== */
		$mois="";
		if($ligne['mois']==1){
			$mois = "Janvier";
		}else if($ligne['mois']==2){
			$mois = "Février";
		}
		else if($ligne['mois']==3){
			$mois = "Mars";
		}
		else if($ligne['mois']==4){
			$mois = "Avril";
		}
		else if($ligne['mois']==5){
			$mois = "Mai";
		}
		else if($ligne['mois']==6){
			$mois = "Juin";
		}
		else if($ligne['mois']==7){
			$mois = "Juillet";
		}
		else if($ligne['mois']==8){
			$mois = "Aout";
		}
		else if($ligne['mois']==9){
			$mois = "Septembre";
		}
		else if($ligne['mois']==10){
			$mois = "Octobre";
		}
		else if($ligne['mois']==11){
			$mois = "Novembre";
		}
		else if($ligne['mois']==12){
			$mois = "Décembre";
		}
		echo '<div id="rensAct">';
		echo '<table border=0>';
		echo '<tr><th>LIBELLE</th><th>MONTANT</th><th>MOIS</th></tr>';



		/* ====CONVERSION ETAT==== */
		while($ligne){
			$idFrais ="";
		if($lst_frais == "Etape/"){
			$requete = 'select mois,quantite, idFraisForfait
		from lignefraisforfait
		where idvisiteur="'.$id.'"
		and mois ="'.$dateMois.'"
		and idFraisForfait ="ETP"';
			$idFrais ="Etape";
			$resultat= $connexion->query($requete);
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
		else if($lst_frais == "Nuitée/"){
			$requete = 'select mois,quantite, idFraisForfait
		from lignefraisforfait
		where idvisiteur="'.$id.'"
		and mois ="'.$dateMois.'"
		and idFraisForfait ="NUI"';
			$idFrais = "Nuitée hotel";
			$resultat= $connexion->query($requete);
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
		else if($lst_frais == "Repas/"){
			$requete = 'select mois,quantite, idFraisForfait
		from lignefraisforfait
		where idvisiteur="'.$id.'"
		and mois ="'.$dateMois.'"
		and idFraisForfait ="REP"';
			$idFrais = "Repas";
			$resultat= $connexion->query($requete);
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
		else if($lst_frais == "Kilomètre/"){
			$requete = 'select mois,quantite, idFraisForfait
		from lignefraisforfait
		where idvisiteur="'.$id.'"
		and mois ="'.$dateMois.'"
		and idFraisForfait ="KM"';
			$idFrais = "Kilomètre";
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}
			echo"<tr><td>".$idFrais."</td><td>".$ligne['quantite']."</td>
			<td>".$mois."</td></tr>";
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		}

		echo '</table>';
		echo '</div>';



	}else{
		echo "Pas de connexion!";
	}


?>

<div id="montant">
<form name = "frmFormulaire" action="rensAffiModifGSB.php" method="post" onSubmit="return verif_formulaire()">
	<table border=0>
	<tr><td>Montant: </td><td><input type=text name="txtMontant" required="required"></td></tr>
	<tr><td><INPUT type="submit" value="Valider" class="submit">
	</td><td><INPUT type="reset" value="Effacer" class="submit"></td></tr>

	</table>
</form>

</div>
</div>
<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->



 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>
