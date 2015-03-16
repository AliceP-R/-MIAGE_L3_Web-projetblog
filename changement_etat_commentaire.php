<?php 
	session_start(); 
  if(!isset($_SESSION['pseudo']))
    header("Location: ./connexion.php"); 

?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Modération de commentaire</TITLE>
	</HEAD>
	<BODY>
		<?php
			// Récupération des données relatives au billet 
			include("config.php"); 
			$_SESSION['titre']=$_GET['titre']; 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      		$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  			$requete = "SELECT `Contenu`, `Emetteur` FROM `commentaire` WHERE ID=".$_GET['id'].";";
  			$res=mysqli_query($cid, $requete);
  			//Fin du SQL

  			//Si la requete echoue
  			if($res == FALSE) 
        		echo "ERREUR de requete";
  			//Si la requete renvoie un résultat...   
  			else
  			{
  				$ligne = mysqli_fetch_assoc($res); 
				echo "<form method=\"post\" action=\"\">"; 
				echo "<legend> Commentaire sur le billet ".$_SESSION['titre']."</legend>"; 
   				echo "<label>Emetteur</label>";
   				echo "<br/><textarea rows='1' cols='50' disabled='disabled'>".$ligne['Emetteur']."</textarea>"; 
   				echo "<br/><label>Contenu</label>";
   				echo "<br/><textarea rows='30' cols='50' disabled='disabled'>".$ligne['Contenu']."</textarea><br/>";
   				echo "<input type=\"submit\" name=\"Envoyer\" value=\"Publié\"/>"; 
   				echo "<input type=\"submit\" name=\"retour\" value=\"Retour\"/>"; 
   				echo "</form>"; 
			}


			if(isset($_POST['retour']))
			{
				header("Location: ./moderer_commentaire.php"); 
			}
			
			elseif(isset($_POST['Envoyer']))
			{
				$requete = "UPDATE `commentaire` SET `Etat` = 'Publie' WHERE `commentaire`.`ID` = ".$_GET['id'].";"; 
				$res=mysqli_query($cid, $requete); 

				if($res == FALSE)
				{ 
					$_SESSION['commentaire_ok']=0; 
					echo "Erreur dans la publication."; 
				}
				else
				{
					$_SESSION['commentaire_ok']=1; 
					header("Location: ./moderer_commentaire.php"); 
				}
			}
		?>
	</BODY>
</HTML>
