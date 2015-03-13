<?php 
	session_start();
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Accueil </TITLE>
	</HEAD>
	<BODY>
		<form method="POST" action="">
			<input type="submit" name="bouton_connexion" value="Se connecter" />
			<input type="submit" name="bouton_inscription" value="S'incrire" />
			<input type="submit" name="acces_blog" value="Accéder au blog" />
		</form>

		<?php
		if(isset($_POST['bouton_connexion']))
    		{
      			header("Location: ./connexion.php"); 
      		}
      		elseif(isset($_POST['bouton_inscription']))
      		{
      			header("Location: ./inscription.php"); 
      		}
      		elseif(isset($_POST['acces_blog']))
      		{
      			echo "accès blog"; 
      		}
      	?>
	</BODY>
</HEAD>