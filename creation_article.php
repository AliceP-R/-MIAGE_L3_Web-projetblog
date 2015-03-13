<?php 
	session_start();
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Création un billet </TITLE>
	</HEAD>
	<BODY>
		<?php 
		if($_SESSION['actualisation'] == 1)
			echo "<br/>Vous avez déjà écrit un billet ayant ce titre \"".$_SESSION['titre']."\"<br/>"; 
		?>
		<form method="POST" action="">
			<label for="titre">Titre de votre billet</label><br />
			<input type="text" name="titre"><br/>
			<label for="titre">Résumer de votre billet</label><br />
			<textarea name="resumer" rows="10" cols="50"><?php if(isset($_SESSION['resumer'])) echo $_SESSION['resumer'];?></textarea><br/>
			<label for="titre">Contenu de votre billet</label><br />
			<textarea name="contenu" rows="30" cols="50"><?php if(isset($_SESSION['contenu'])) echo $_SESSION['contenu'];?></textarea><br/>
			<input type="submit" name="Envoyer" value="J'ai terminé !"> 
			<input type="submit" name="retour" value="Retour"> 
		</form>

		<?php
			include("config.php"); 

			if(isset($_POST['retour']))
			{
				header("Location: ./page_perso.php"); 
			}

			if(isset($_POST['Envoyer']))
    		{
    			$_SESSION['titre']=$_POST['titre']; 
    			$_SESSION['contenu']=$_POST['contenu']; 
    			$_SESSION['resumer']=$_POST['resumer']; 

    			if($_POST['titre'] == "" || $_POST['contenu']== "" || $_POST['resumer'] == "")
    			{
    				die("Il manque des informations.<br/>"); 
    			}

    			/*Connection a la base de données*/
      			if(!($cid=mysql_connect("localhost", $user,$password)))
      			{
					die("Erreur de connexion à la base de données.<br/>");
      			}

				mysql_select_db("projet_blog");
      			
      			//Debut du SQL
      			$requete = "INSERT INTO `billet`(`Titre`, `Resumer`, `Contenu`, `Redacteur`) 
      						VALUES ('".$_POST['titre']."', '".$_POST['resumer']."', '".$_POST['contenu']."', '".$_SESSION['pseudo']."');";  
  				$res=mysql_query($requete, $cid);
  				//Fin du SQL  
  				//Si l'insertion a échoué => Message d'erreur
  				if($res == FALSE) 
  				{
  					$_SESSION['actualisation']=1; 
  					header("Location: ./creation_article.php"); 

  				}
  				//Si l'insertion est réussi => Message de succès
  				else 
  				{
  					$_SESSION["billet_soumis"]=1; 
					header("Location: ./page_perso.php"); 
  				}

  					
      		}
		?>
	</BODY>
</HTML>