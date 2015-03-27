<?php 
	session_start(); 
  if(!isset($_SESSION['pseudo']))
  {
    $_SESSION['blog']=1; 
    $_SESSION['com_billet']=1; 
    header("Location: ./connexion.php"); 
  }
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
		<TITLE> Ajout d'un commentaire </TITLE>
	</HEAD>
	<BODY>
    <fieldset>
      <legend> Création de commentaire </legend>
		<form method="POST" action="">
			<label for="titre">Contenu</label><br />
			<textarea name="contenu" rows="10" cols="50"></textarea><br/>
			<input type="submit" name="Envoyer" value="J'ai terminé !"> 
			<input type="submit" name="retour" value="Retour"> 
		</form>
    </fieldset>

		<?php
			include("config.php"); 

			if(isset($_POST['retour']))
			{
				header("Location: ./liste_commentaire.php?billet=".$_GET['billet']); 
			}

			if(isset($_POST['Envoyer']))
    		{
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

      		$requete = "INSERT INTO `commentaire` (`Billet`, `Emetteur`, `Contenu`, `Etat`, `date_ajout`) VALUES (".$_GET['billet'].", \"".$_SESSION['pseudo']."\", \"".$_POST['contenu']."\", \"".$etat."\", NOW());";
  				$res=mysqli_query($cid, $requete);
  				//Fin du SQL  
  				//Si l'insertion a échoué => Message d'erreur
  				if($res == FALSE) 
  				{
  					echo "problème requete"; 
  				}
  				//Si l'insertion est réussi => Message de succès
  				else 
  				{
            $_SESSION['ajout_com']=1; 
  					header('Location: ./liste_commentaire.php?billet='.$_GET['billet']); 
  				}	
      	}
		?>
	</BODY>
</HTML>