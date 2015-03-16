<?php 
	session_start(); 
?>
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
	  		<input type="password" name="cmdp" placeholder="Confirmation du mot de passe"/>
	  		<input type="submit" name="Valider" value="S'inscrire"/>
	  	</form>
	  	<?php
	  		include("config.php");

      		/*Si l'utilisateur clique sur Valider*/
      		if(isset($_POST['Valider']))
      		{
      			if(($_POST['Login'] == "") || ($_POST['mdp'] == "") || ($_POST['cmdp'] == ""))
	  			{
	  				die("Vous n'avez pas rempli tout les champs"); 
	  			}
	  			else
	  			{
      				if($_POST['mdp'] != $_POST['cmdp'])
	  				{
	  					die("Mot de passe différents"); 
	  				}

					/*Connection a la base de donnée*/
					if(!($cid=mysqli_connect("localhost", $user,$password, "projet_blog")))
					{
	  					die("Erreur à la connexion de la base de données");
					}
					//cryptage du mot de passe entré par l'utilisateur
  					$mdps=sha1($_POST['mdp']);
  
  					//Debut du SQL
  					$requete = "INSERT INTO  `projet_blog`.`utilisateur`(`Login`, `Mdp`, `Droit`) 
  								VALUES ('".$_POST['Login']."',  '".$mdps."',  'Lambda');"; 

  					$res=mysqli_query($cid, $requete);
  					//Fin du SQL  
  					//Si l'insertion a échoué => Message d'erreur
  					if($res == FALSE) 
  					{
  						echo "<br/>Inscriton ratée<br/>"; 
  						echo "Ce login existe déjà<br/>"; 
  					}
  					//Si l'insertion est réussi => Message de succès
  					else 
  					{
  						$_SESSION["juste_inscrit"]=1; 
  						$_SESSION["pseudo"]=$_POST['Login']; 
  						$_SESSION['billet_soumis']=0;
  						$_SESSION['modif_ok']=0; 
  						header("Location: ./page_perso.php"); 
  					}
    			}
			}
	  	?>
	  	<label for="bouton_connexion">Déjà inscrit ? Cliquez ici !</label><br/>
	  	<form method="POST" action="connexion.php">
			<input type="submit" name="bouton_connexion" name="Se connecter" value="Connexion" />
		</form>
	</BODY>
</HTML>