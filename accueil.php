<?php 
	session_start(); 
	$_SESSION['blog']=0;
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<link rel="stylesheet" href="style.css" />
		<TITLE> Accueil </TITLE>
		<meta charset="utf-8">
	</HEAD>
	<BODY>
		<fieldset> 
   		<legend> Bienvenue sur notre blog ! </legend> 
		<form method="POST" action="">
			<?php 
				if(!isset($_SESSION['pseudo'])): ?>
				
					<input type="submit" name="bouton_connexion" value="Se connecter"/>
					<input type="submit" name="bouton_inscription" value="S'incrire" />
				<?php else : ?>
				
					<input type="submit" name="deco" value="Se déconnecter" />
				<?php endif; ?>
			
			<input type="submit" name="acces_blog" value="Accéder au blog" />
		</form>
		</fieldset>

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