<?php 
	session_start(); 
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
			<input type="submit" name="bouton_modifier" value="Modifier un article" />
			<input type="submit" name="bouton_voir" value="Voir mes articles" />
			<input type="submit" name="acces_blog" value="Accéder au blog" />
		</form>
		<?php 
			if($_SESSION['billet_soumis']==1)
			{
				echo "Votre billet \"".$_SESSION['titre']."\" a bien été soumis à modération, il sera publié dans les plus brefs délais.<br/>"; 
			}
			$_SESSION['titre']=null; 
			$_SESSION['resumer']=null; 
			$_SESSION['contenu']=null; 
			$_SESSION['actualisation']=0; 
			$_SESSION['billet_soumis']=0; 


			// gestion des boutons

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
			elseif(isset($_POST['acces_blog']))
      		{
      			echo "accès blog"; 
      		}
		?>
	</BODY>
</HEAD>