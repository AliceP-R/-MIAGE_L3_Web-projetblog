<?php session_start(); ?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Inscription </TITLE>
	</HEAD>
	<BODY>
	<form method="POST" action="">
		<label for="login">Identifiant</label><br />
		<input type="text" name="login" id="login"/><br />
		<label for="password">Mot de Passe</label><br />
		<input type="password" name="mdp" id="password"/><br /><br />
		<input type="submit" name="Valider" value="Connexion" />
	</form>
	<label for="bouton_inscript">Vous n'êtes pas inscrit ? Cliquez ici !</label><br/>
	<form method="POST" action="inscription.php">
		<input type="submit" name="bouton_inscript" name="S'inscrire" value="Inscription" />
	</form>


	<?php
		include("config.php");

		function connexion($cid, $login, $mdp) 
		{
  			//Cryptage du mdp pour le comparer a celui de la BD
  			$mdps=sha1($mdp);
  
  			//Début du SQL
  			$requete = "SELECT `Mdp` FROM `utilisateur` WHERE `login`=\"".$_POST['login']."\";";
  			$res=mysqli_query($cid, $requete);
  			//Fin du SQL
  
  			//Si la requete echoue
  			if($res == FALSE) 
    			echo "ERREUR de requete";
  
  			//Si la requete renvoie un résultat...   
  			else
  			{
    			//..on le stock dans $arr...
    			$arr=mysqli_fetch_assoc($res);
    
			    //...et on le compare avec le mdp envoyé par l'utilisateur.
    			if($arr['Mdp']==$mdps)
      				return TRUE;
      
			    else
      				return FALSE;
  			}
		}

    	/*Si l'utilisateur clique sur valider*/
    	if(isset($_POST['Valider']))
    	{
      		/*Connection a la base de données*/
      		if(!($cid=mysqli_connect("localhost", $user,$password, "projet_blog")))
      		{
				die("Erreur de connexion à la base de données.<br/>");
      		}
  
	    	//Si les champs ne sont pas vides...
    		if(strcmp($_POST['login'], "") != 0 AND strcmp($_POST['mdp'], "") !=0)
      		{
				//...on les envois à la fonction connexion qui renvoi une valeur stockée dans $connex...
				$connex=connexion($cid, $_POST['login'], $_POST['mdp']);
	
				//...si les identifiants sont corects...
				if($connex==TRUE)
				{
	  				//...on enregistre le pseudo dans une variable de session et on envoi l'utilisateur sur sa page perso.
	  				$_SESSION['pseudo']=$_POST['login'];
	  				header("Location: ./page_perso.php"); 
				}
	
				//...sinon on affiche un message d'erreur.
				else
				{
	  				echo "Identifiants incorrects.";
				}
      		}
      
      		//Si l'utilisateur n'a pas entré de login => Message d'erreur
      		else if(strcmp($_POST['login'], "") == 0)
      		{
	  			echo "Entrez votre login.";
			}

		    //Si l'utilisateur n'a pas entré de mdp => Message d'erreur
      		else if(strcmp($_POST['mdp'], "") ==0)
      		{
	  			echo "Entrez votre mot de passe.";
			}
    	}
	?>
	</BODY>
</HTML>