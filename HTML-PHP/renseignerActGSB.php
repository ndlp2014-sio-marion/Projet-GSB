<html>
<head>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/renseignerFraisGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Renseigner frais</title>
	
</head>
<body>

<title>
Renseigner frais
</title>



			<p>
			<a href="accueilDecGSB.php">Accueil</a>
			<a href="accueilGSB.html">Déconnexion</a>
			
			</p>
          
    

<div id="bienvenue">
<div class="bandeau-gauche">
 



<?php

	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	if($connexion){
		mysql_select_db("gsbv3");
		$login = $_SESSION['login'];
		$pass = $_SESSION['pass'];
		$id = $_SESSION['id'];
		/* =====1ER TEST===== */
		$requete = 'select mois,montantValide,nbJustificatifs
					from fichefrais, visiteur
					where fichefrais.idVisiteur =visiteur.id
						and visiteur.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp ="'.$pass.'")
						and mois = "'.$_POST['lst_mois'].'"';
		$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		echo "<table border =1>";
		echo "<h2>Frais forfait:</h2>";
		echo "<tr><th>MOIS</th><th>MONTANT VALIDE</th><th>NOMBRE JUSTIFICATIFS</th></tr>";
		
		
		while($ligne){
			echo"<tr><td>".$ligne['mois']."</td><td>".$ligne['montantValide']."</td>
			<td>".$ligne['nbJustificatifs']."</td></tr>";
			$ligne = mysql_fetch_assoc($resultat);
		}
		/* =====FRAIS FORFAIT===== */
		$requete = 'select mois,montantValide,nbJustificatifs
					from ligneFraisForfait, ficheFrais
					where fichefrais.idVisiteur =ligneFraisForfait.idVisiteur
						and fichefrais.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp ="'.$pass.'")
						and mois = "'.$_POST['lst_mois'].'"';
		$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		echo "<table border =1>";
		echo "<h2>Frais forfait:</h2>";
		echo "<tr><th>MOIS</th><th>MONTANT VALIDE</th><th>NOMBRE JUSTIFICATIFS</th></tr>";
		
		
		while($ligne){
			echo"<tr><td>".$ligne['mois']."</td><td>".$ligne['montantValide']."</td>
			<td>".$ligne['nbJustificatifs']."</td></tr>";
			$ligne = mysql_fetch_assoc($resultat);
		}
		
		/* =====FRAIS HORS-FORFAIT===== */
		$requete = 'select mois,montant,ficheFrais.libelle, dateHF
					from ligneFraisHorsForfait, ficheFrais
					where fichefrais.idVisiteur =ligneFraisHorsForfait.idVisiteur
						and fichefrais.id =(select id
											from visiteur
											where login= "'.$login.'"
											and mdp ="'.$pass.'")
						and mois = "'.$_POST['lst_mois'].'"';
		$resultat = mysql_query($requete,$connexion);
		$ligne =mysql_fetch_assoc($resultat);
		echo "<table border =1>";
		echo "<h2>Frais forfait:</h2>";
		echo "<tr><th>MOIS</th><th>MONTANT</th><th>LIBELLE</th><th>DATE</th></tr>";
		
		
		while($ligne){
			echo"<tr><td>".$ligne['mois']."</td><td>".$ligne['montant']."</td>
			<td>".$ligne['ficheFrais.libelle']."</td><td>".$ligne['dateHF']."</td></tr>";
			$ligne = mysql_fetch_assoc($resultat);
		}
		
		/* =====TYPE CONNEXION===== */
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
		echo "</div>";
		//$requete = 'insert into ficheFrais values("'.$id.'","'.$_POST["'txtDateFrais'"].'","'nbJustificatifs'"?
		//"'.$_POST["'txtMontantFrais'"].'","'.$_POST["'txtDateFrais'"].'","'idEtat'")';
		//idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat?
		
		//$requete = "intert into autresFrais values ($_POST['txtDateFrais'], $_POST['txtAutresFrais'],
		//$_POST['txtMontantFrais'])"
		
		/* =====DATE COURANTE===== */
		$dateCourante = date("d-m-Y");
		$dateMois = date("m");
		//echo "date courante = ".$dateCourante;
		if(isset($_POST['txtForfaitEtape']) ) {
			$requete = 'insert into ligneFraisForfait values("ETP","'.$id.'","'.$_POST["txtForfaitEtape"]'")';
			//recuperer la date courant
			//faut il -pas plutot insert sur fraisforfait
			//pourquoi qu'une requete d'ajout
		} 
		if(isset($_POST['txtForfaitKilo'])){
			$requete = 'insert into ligneFraisForfait values("KM","'.$id.'","'.$_POST["txtForfaitKilo"]'")';
		}
		if(isset($_POST['txtForfaitRep'])){
			$requete = 'insert into ligneFraisForfait values("REP","'.$id.'","'.$_POST["txtForfaitRep"]'")';
		}
		$requete 'select mois from fichefrais;';
		$resultat =mysql_query($requete,$connexion);
		$ligne = mysql_fetch_assoc($resultat);
		
		/* =====VERIFICATION MOIS===== */
		$vf = false;
		while($ligne){
			if($ligne['mois'] == $dateMois ){
				$vf = true;
			}
			//comment sortir de la boucle sans avoir parcouru tous les mois ?
			$ligne = mysql_fetch_assoc($resultat);
		}
		if($vf == false){
			$requete ='insert into fichefrais('.$id.','.$dateMois.',0,'montantValide','dateModif','idetat')';
		}
		
		$requete = 'insert into autresFrais values
		("'.$_POST["txtDateFrais"].'","'.$_POST["txtAutresFrais"].'",
		"'.$_POST["txtMontantFrais"].'")';
		//$requete ='insert into ligneFraisForfait values()';
		//insert into utilisatuer('','',NOW());
		//mois,quantite
		
		echo "</table>";
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);


?>

<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>
</div>
 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>

</body>
</html>