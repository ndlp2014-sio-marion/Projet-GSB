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


			<header>
			<p>
			<a href="accueilDecGSB.php">Accueil</a>
			<a href="renseignerDecFraisGSB.php">Retour</a>
			<a href="index.html">Déconnexion</a>
			</p>
			</header>



<div class="bandeau-gauche">




<?php


	session_start();
	$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");
	if($connexion){

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
											and mdp ="'.$pass.'")';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		/* =====DATE COURANTE===== */
		$dateCourante = date("Y-m-d");
		$dateMois = date("m");
		$dateJour = date("d");
		$dateM1 = $dateMois-1;

		/* =====TYPE VISITEUR===== */
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
			
		}
		
		echo "<h1><br>Renseigner frais</h1>";

		


		//pk dateM1? pour cloturée l'ancienne fiche de frais
		if($dateM1 == 0){
			$dateM1 =12;
		}
		//echo "date courante = ".$dateCourante;
		$requete ='select * from fichefrais where mois= "'.$dateMois.'"
		and idvisiteur ="'.$id.'";';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		/* ====MODIFICATION FICHE FRAIS==== */
		if(!$ligne){//il n'y a pas de fiche existante pour le mois courant
			//on cloture l'ancienne fiche
			$requete='update fichefrais set idEtat="CL"
				where mois="'.$dateM1.'"
				and idvisiteur ="'.$id.'"';//ok
				$resultat= $connexion->query($requete);

			$montant = $_POST['txtForfaitEtape']+$_POST['txtForfaitKilo']+$_POST['txtForfaitNuit']+$_POST['txtForfaitRep'];
			//saisie en cours
				$requete = 'insert into ficheFrais values("'.$id.'","'.$dateMois.'"
				,"0","'.$montant.'","'.$dateCourante.'","CR")';
				$resultat= $connexion->query($requete);
				

		}


			if($dateJour == 28){// au 28 eme jour on valide et mise en paiement
				$requete='update fichefrais set idEtat="VA"
				where mois="'.$dateMois.'"
				and idvisiteur ="'.$id.'"';//ok
				$resultat= $connexion->query($requete);
				if($resultat){
					//echo "VA modifié";
				}
				else{
					//echo "va non modifié";
				}
			}
			else if($dateJour == 25){
				$requete='update fichefrais set idEtat="RB"
				where mois="'.$dateMois.'"
				and idvisiteur ="'.$id.'"';//ok
				$resultat= $connexion->query($requete);
				
			}


		 /* ====INSERTION DES FRAIS==== */
		//if(isset($_POST['txtForfaitKilo']) && isset($_POST['txtForfaitRep']) && isset($_POST['txtForfaitNuit'])&& isset($_POST['txtForfaitEtape']) ){
			//echo "lkfjglkfjdglkfjglkjfgklj";
			$requete = 'insert into ligneFraisForfait values("'.$id.'","'.$dateMois.'","KM","'.$_POST["txtForfaitKilo"].'")';
			$resultat= $connexion->query($requete);


			$requete = 'update fichefrais set dateModif="'.$dateCourante.'"
				where mois="'.$dateMois.'"
				and idvisiteur ="'.$id.'"';
				$resultat= $connexion->query($requete);

				$requete = 'insert into ligneFraisForfait values("'.$id.'","'.$dateMois.'","REP","'.$_POST["txtForfaitRep"].'")';
			$resultat= $connexion->query($requete);


			$requete = 'insert into ligneFraisForfait values("'.$id.'","'.$dateMois.'","NUI","'.$_POST['txtForfaitNuit'].'")';
			$resultat= $connexion->query($requete);


				$requete = 'insert into ligneFraisForfait values("'.$id.'","'.$dateMois.'","ETP","'.$_POST["txtForfaitEtape"].'")';
			$resultat= $connexion->query($requete);

			//}

$requete ='select mois,idFraisForfait,quantite
		from lignefraisforfait
		where idVisiteur ="'.$id.'"
		and mois= "'.$dateMois.'"
		';
		$resultat= $connexion->query($requete);
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		echo "<div id='consulterAct'>";
		echo '<table border=0>';
		echo '<tr><th>NOM</th><th>MOIS</th><th>FRAIS</th><th>MONTANT</th></tr>';
		
		/* ====CONVERSION DU MOIS====*/
		while($ligne){

			if($dateMois ==1){
				$dateModif ="Janvier";

			}
			else if($dateMois == 2){
				$dateModif ="Février";
			}
			else if($dateMois == 3){
				$dateModif ="Mars";
			}
			else if($dateMois ==4){
				$dateModif ="Avril";
			}
			else if($dateMois == 5){
				$dateModif ="Mai";
			}

			else if($dateMois == 6){
				$dateModif ="Juin";
			}

			else if($dateMois == 7){
				$dateModif ="Juillet";
			}

			else if($dateMois == 8){
				$dateModif ="Aout";
			}


			else if($dateMois == 9){
				$dateModif ="Septembre";
			}

			else if($dateMois == 10){
				$dateModif ="Octobre";
			}

			else if($dateMois == 11){
				$dateModif ="Novembre";
			}


			else if($dateMois == 12){
				$dateModif ="Décembre";
			}
			$idFrais= "";
			if($ligne['idFraisForfait'] == "ETP" ){
				$idFrais ="Etape";
			} else if($ligne['idFraisForfait'] == "REP" ){
				$idFrais ="Repas";
			}
			else if($ligne['idFraisForfait'] == "KM"){
				$idFrais ="Kilomètre";
			}
			else if($ligne['idFraisForfait'] == "NUI"){
				$idFrais ="Nuitée";
			}

			echo '<tr><td>'.$login.'</td><td>'.$dateModif.'</td><td>'.$idFrais.'</td><td>'.$ligne['quantite'].'</td></tr>';
			$ligne =$resultat->fetch(PDO::FETCH_ASSOC);
		}


		echo '</div>';
		echo '</table>';

	}else{
		echo "Pas de connexion!";
	}




?>

<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->

</div>
</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>


</html>
