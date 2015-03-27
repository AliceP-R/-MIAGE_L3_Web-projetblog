<?php 
	session_start(); 
  $_SESSION['blog']=0;
  if(!isset($_SESSION['pseudo']))
    header("Location: ./connexion.php"); 

?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
		<TITLE> Création un billet </TITLE>
	</HEAD>
	<BODY>
		<?php 
		if($_SESSION['actualisation'] == 1)
			echo "<br/><p>Vous avez déjà écrit un billet ayant ce titre \"".$_SESSION['titre']."\"</p><br/>"; 
		?>
    <fieldset> 
      <legend> Création d'un nouveau billet </legend> 
		<form method="POST" action="">
			<label>Titre de votre billet</label><br />
			<input type="text" name="titre"><br/>
			<label>Résumer de votre billet</label><br />
			<textarea name="resumer" rows="10" cols="50"><?php if(isset($_SESSION['resumer'])) echo $_SESSION['resumer'];?></textarea><br/>
			<label>Contenu de votre billet</label><br />
			<textarea name="contenu" rows="30" cols="50"><?php if(isset($_SESSION['contenu'])) echo $_SESSION['contenu'];?></textarea><br/>
			<input type="submit" name="Envoyer" value="J'ai terminé !"> 
			<input type="submit" name="retour" value="Retour"> 
		</form>
  </fieldset>

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
    				die("<p class=\"erreur\">Il manque des informations.</p><br/>"); 
    			}

    			/*Connection a la base de données*/
      			if(!($cid=mysqli_connect("localhost", $user,$password, "projet_blog")))
      			{
					die("Erreur de connexion à la base de données.<br/>");
      			}

      			//Debut du SQL
            if($_SESSION['Droit']=="Admin")
              $etat="Publie"; 
            else
              $etat="En attente"; 

      			$requete = "INSERT INTO `billet`(`Titre`, `Resumer`, `Contenu`, `Redacteur`, `Etat`, `date_creation`, `derniere_modif`) 
      						VALUES ('".$_POST['titre']."', '".$_POST['resumer']."', '".$_POST['contenu']."', '".$_SESSION['pseudo']."', '".$etat."', NOW(), NOW());";  
  				$res=mysqli_query($cid, $requete);
  				//Fin du SQL  
  				//Si l'insertion a échoué => Message d'erreur
  				if($res == FALSE) 
  				{
  					$_SESSION['actualisation']=1; 
  					header("Location: ./creation_billet.php"); 

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