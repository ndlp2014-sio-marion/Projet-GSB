<html>
<head>
<meta charset="utf-8" />

</head>
<body>

<title>
Connexion
</title>
<?php

	
	if(($_POST["user1"]) == "lvillachane"){
		if(($_POST["pass1"]) == "jux7g"){
			echo 'Bonjour vous êtes connectés!!';
		}
	}else{
		
		echo 'Bonjour vous n\'êtes  pas connectés!!';
	}
?>
</body>
</html>