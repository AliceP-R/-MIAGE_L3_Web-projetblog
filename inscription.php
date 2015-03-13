<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Inscription </TITLE>
	</HEAD>
	<BODY>
		<form action="" method="post">
	  		<input type="text" name="Login" placeholder="Login"/>
	  		<input type="password" name="mdp" placeholder="Mot de passe"/>
	  		<input type="submit" name="Valider" value="S'inscrire"/>
	  	</from>
	  	<?php
	  		include("config.php");

      		/*Si l'utilisateur clique sur Valider*/
      		if(isset($_POST['Valider']))
      		{
				/*Connection a la base de donnée*/
				if(!($cid=mysql_connect("localhost", $user,$password)))
				{
	  				die("erreur");
				}
				//cryptage du mot de passe entré par l'utilisateur
  				$mdps=sha1($_POST['mdp']);
  
  				//Debut du SQL
  				$requete = "INSERT INTO  `projet_blog`.`utilisateur`(`Login`, `Mdp`, `Droit`) 
  							VALUES ('".$_POST['Login']."',  '".$mdps."',  'Lambda');"; 

  				mysql_select_db("test");
  				$res=mysql_query($requete, $cid);
  				//Fin du SQL  
  				//Si l'insertion a échoué => Message d'erreur
  				if($res == FALSE) 
  				{
  					echo "<br/>Inscriton ratée<br/>"; 
  					echo "Ce login existe déjà"; 
  				}
  				//Si l'insertion est réussi => Message de succès
  				else 
    				echo "Inscription ok"; 
			}
	  	?>
	</BODY>
</HTML>