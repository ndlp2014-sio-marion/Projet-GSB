<html>

	<head>
	<meta charset="utf-8" />

	<link rel="stylesheet" href="CSS/connexGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Connexion</title>


<body>



		<header>

            <p><a href="index.html">Accueil</a>
			<a href="connexionGSB2.php">Connexion</a>
			</p>

		</header>
		<div class="bandeau-gauche">


<form name="frmFormulaire" method="post" action="connexionGSB2.php" >
  <h1><span class="entypo-login"></span>Connexion</h1>

  <span class="entypo-user inputUserIcon"></span>
  <input type="text" name="user1" class="user" placeholder="Utilisateur" required="required"/>
  <span class="entypo-key inputPassIcon"></span>
  <input type="password" name="pass1" class="pass"placeholder="Mot de passe" required="required"/>
 <button class="submit">ENTRER<span class="entypo-lock"></span></button>
 <?php

$connexion = new PDO("mysql:host=localhost;dbname=gsbv3", "root", "");


	if($connexion){
		//mysql_select_db("gsbv3",$connexion);
		$requete = "select login,mdp,id from visiteur;";
	$resultat= $connexion->query($requete);
$ligne =$resultat->fetch(PDO::FETCH_ASSOC);

		while($ligne){
			if(isset($_POST['user1']) && isset($_POST['pass1']) ) {

			if($_POST['user1'] == $ligne["login"] && $_POST['pass1'] == $ligne["mdp"]) {
					session_start();
					$_SESSION['login'] =$_POST['user1'];
					$_SESSION['pass'] = $_POST['pass1'];
					$_SESSION['id'] = $ligne["id"];
					echo header('Location:accueilDecGSB.php') ;
				}


		}
		$ligne =$resultat->fetch(PDO::FETCH_ASSOC);


	}

	if(isset($_POST['user1']) && isset($_POST['pass1'])) {
	if($_POST['user1'] != $ligne["login"] || $_POST['pass1'] != $ligne["mdp"]){
			echo "CONNEXION REFUSÉE";
		}
	}
	}else{

		echo "Pas de connexion!";
	}
	
	
?>
</form>

  </div>
</div>



  </body>
  </div>
</html>
