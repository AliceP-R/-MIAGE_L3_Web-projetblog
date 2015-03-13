<?php 
	session_start(); 
	$_SESSION['titre']=null; 
	$_SESSION['contenu']=null; 
	$_SESSION['actualisation']=0; 
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Page de <?php echo $_SESSION['pseudo'];?> </TITLE>
	</HEAD>
	<BODY>
		Bonjour <?php echo $_SESSION['pseudo']; ?> !
		Que voulez vous faire aujourd'hui ? 
		<form method="POST" action="">
			<input type="submit" name="bouton_creer" value="Créer un article" />
		</form>
		<form method="POST" action="">
			<input type="submit" name="bouton_modifier" value="Modifier un article" />
		</form>
		<form method="POST" action="">
			<input type="submit" name="bouton_voir" value="Voir mes articles" />
		</form>

		<?php // gestion des boutons

    	if(isset($_POST['bouton_creer']))
    	{
      		header("Location: ./creation_article.php"); 
      	}
      	elseif(isset($_POST['bouton_modifier']))
      	{
      		header("Location: ./modification_article.php"); 
      	}
      	elseif(isset($_POST['bouton_voir']))
      	{
      		header("Location: ./afficher_article.php"); 
      	}

		?>
	</BODY>
</HEAD>