<html>

	<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/connexGSB.css" />
	<link rel="icon" type="image/ico" href="CSS/iconeGSB.jpg" />
	</head><title>Connexion</title>
	
	
<body>
	 




            <p><a href="accueilGSB.html">Accueil</a>
			<a href="connexGSB.html">Connexion</a>
			</p>
	

<form method="post" action="connexGSB2.php">
  <h1><span class="entypo-login"></span>Connexion</h1>
  <button class="submit"><span class="entypo-lock"></span></button>
  <span class="entypo-user inputUserIcon"></span>
  <input type="text" name="user1" class="user" placeholder="Utilisateur"/>
  <span class="entypo-key inputPassIcon"></span>
  <input type="password" name="pass1" class="pass"placeholder="Mot de passe"/>
  <?php
	
	
		
		
	if(isset($_POST['user1']) && isset($_POST['pass1']) ) {
		
		if($_POST['user1'] === 'lvillachane' && $_POST['pass1'] == 'jux7g') { 

			echo header('Location:accueilDecGSB.html') ; } 
			else { echo 'CONNEXION REFUSEE'; } 
	}
	
?>
</form>
   
  </div>
</div>
    

    
	

  </body>
</html>