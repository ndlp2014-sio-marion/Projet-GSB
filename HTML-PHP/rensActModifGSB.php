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
    

<div id="bienvenue">

	<h1>Modification des données: </h1> 

</div>
<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	$connexion = mysql_connect("localhost","root","");
	$i=0;
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
			echo "<div id='type'>Comptable/".$login."</div>";
			//echo 'Bonjour'.$login;
		}
		echo "</div>";
		
		/*
		$requete = 'select libelle,montant, fraisforfait.id
		from lignefraisforfait,fraisforfait
		where lignefraisforfait.idfraisforfait = fraisforfait.id';
		
		$ligne = mysql_fetch_assoc($resultat);
		$libelle = $ligne['libelle'];
		$montant = $ligne['montant'];
		$idFrais = $ligne['lignefraisforfait.id'];
		//$etatFrais = $ligne['fraisforfait.']
		echo '<select name="lst_frais">';
		while($ligne){
			echo '<option selected value='.$idFrais.'>'.$libelle.'/'.$montant.'</option>';
			$ligne = mysql_fetch_assoc($resultat);
		}
		*/
		if((isset($_POST['txtLibelle'])) && (isset($_POST['txtMontant'])) &&(isset($_POST['txtQuantite'])) ){
			echo 'update fraisforfait
			set montant ="txtMontant"
			where idvisiteur = '.$id.'';
		echo 'update lignefraisforfait
		 quantite = "txtQuantite"
			where idvisiteur = '.$id.';';
			
			echo header('Location:renseignerDecFraisGSB.php') ; 
		}
		
		
	}else{
		echo "Pas de connexion!";
	}
	
	mysql_close($connexion);
?>
<script language = "javascript" type="text/javascript">

function verif_formulaire(){
// si la valeur du champ prenom est vide
 if(document.frmFormulaire.txtLibelle.value == "")  {
    // sinon on affiche un message
    alert("Saisissez le libelle");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtClasse.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
 }
</script>

<form name = "frmFormulaire" action="rensActModifGSB.php" method="post" onSubmit="return verif_formulaire()>
	<table border=0>
	<tr><td><h2>Frais forfaitaires:<h2> </td></tr>
	<tr><td>Libelle: </td><td><input type=text name="txtLibelle"></td></tr>
	<tr><td>Montant: </td><td><input type=text name="txtMontant"></td></tr>
	<tr><td>Quantité: </td><td><input type=text name="txtQuantite>"></td></tr>

	<tr><td><INPUT type="submit" value="Valider" class="submit">
	</td><td><INPUT type="reset" value="Effacer" class="submit"></td></tr>
	
	</table>
</form>



<!--<img src="CSS/background-energy.jpg" alt="backEnergy" id="backEnergy"/> -->


</body>

 <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Script perso -->
    <script type="text/javascript" src="mon_script.js"></script>



</html>