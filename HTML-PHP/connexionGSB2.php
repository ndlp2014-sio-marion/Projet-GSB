<html>

	<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="CSS/connexGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Connexion</title>
	
	
<body>
	 


		<header>

            <p><a href="accueilGSB.html">Accueil</a>
			<a href="connexionGSB2.php">Connexion</a>
			</p>
	
		</header>
		<div class="bandeau-gauche">
<script language = "javascript" type="text/javascript">

function verif_formulaire(){
// si la valeur du champ prenom est vide
	
 if(document.frmFormulaire.user1.value != $_POST['login'])  {
    // sinon on affiche un message
    alert("Connexion refusée");
	// le curseur reste positionné sur la zone de texte
	document.frmFormulaire.txtPrenom.focus();
    // et on indique de ne pas envoyer le formulaire
	return false;
  }
 }
</script>
		
<form name="frmFormulaire" method="post" action="connexionGSB2.php" onSubmit="return verif_formulaire()">
  <h1><span class="entypo-login"></span>Connexion</h1>
  
  <span class="entypo-user inputUserIcon"></span>
  <input type="text" name="user1" class="user" placeholder="Utilisateur" required="required"/>
  <span class="entypo-key inputPassIcon"></span>
  <input type="password" name="pass1" class="pass"placeholder="Mot de passe" required="required"/>
 <button class="submit">ENTRER<span class="entypo-lock"></span></button>
 <?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	
	$connexion = mysql_connect("localhost","root","");
	
	if($connexion){
		mysql_select_db("gsbv3",$connexion);
	}else{
		
		echo "Pas de connexion!";
	}
	$requete = "select login,mdp,id from visiteur;";
	$resultat =mysql_query($requete,$connexion);
	$ligne = mysql_fetch_assoc($resultat);
	$vf = true;
	//$cpt;
	//comment vérifier le php seulement si on a cliquer sur entrer ?
	
		while($ligne){
			if(isset($_POST['user1']) && isset($_POST['pass1']) ) {
			//$cpt =$cpt+1;
			if($_POST['user1'] == $ligne["login"] && $_POST['pass1'] == $ligne["mdp"]) { 
					session_start();
					$_SESSION['login'] =$_POST['user1'];
					$_SESSION['pass'] = $_POST['pass1'];
					$_SESSION['id'] = $ligne["id"];
					echo header('Location:accueilDecGSB.php') ; 
				} 
			
			$vf = false;
		}
		$ligne = mysql_fetch_assoc($resultat);
		

	}

	if(isset($_POST['user1']) && isset($_POST['pass1'])) {
	if($_POST['user1'] != $ligne["login"] || $_POST['pass1'] != $ligne["mdp"]){
			echo "CONNEXION REFUSÉE";
		}	
	}
	mysql_close($connexion);
?>
</form>
   
  </div>
</div>
    

   
  </body>
  </div>
</html>