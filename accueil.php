<?php 
	session_start(); 
	$_SESSION['blog']=0;
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE> Accueil </TITLE>
		<meta charset="utf-8">
	</HEAD>
	<BODY>
		<form method="POST" action="">
			<?php 
				if(!isset($_SESSION['pseudo']))
				{
					echo "<input type=\"submit\" name=\"bouton_connexion\" value=\"Se connecter\"/><br/><br/>";
					echo "<input type=\"submit\" name=\"bouton_inscription\" value=\"S'incrire\" /><br/><br/>"; 
				}
				else
					echo "<input type=\"submit\" name=\"deco\" value=\"Se déconnecter\" />"; 
			?>
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
      		header("Location: ./blog.php?page=1"); 
      	}
      	elseif(isset($_POST['deco']))
      	{
      		session_destroy(); 
      		header("Location: ./accueil.php"); 
      	}
      	?>
	</BODY>
</HEAD>