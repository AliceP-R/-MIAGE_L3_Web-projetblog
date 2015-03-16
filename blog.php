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
			<?php 
				if(!isset($_SESSION['pseudo']))
				{
					echo "<input type=\"submit\" name=\"bouton_connexion\" value=\"Se connecter\"/>"; 	
					echo "<input type=\"submit\" name=\"bouton_inscription\" value=\"S'incrire\" />"; 
				} 
			?>
			<input type="submit" name="deco" value="Se déconnecter" />
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
      	elseif(isset($_POST['deco']))
      	{
      		session_destroy(); 
      		header("Location: ./accueil.php"); 
      	}
      	?>

      	Afficher le blog ??? 
	</BODY>
</HEAD>