<?php 
	session_start(); 
	var_dump($_SESSION); 
  if(!isset($_SESSION['pseudo']))
    header("Location: ./connexion.php"); 

?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Modération du billet <?php echo $_GET['titre']; ?> </TITLE>
	</HEAD>
	<BODY>
		<?php

			$_SESSION['titre']=$_GET['titre']; 
			// Récupération des données relatives au billet 
			include("config.php"); 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      		$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  			$requete = "SELECT `Resumer`, `Contenu` FROM `billet` WHERE `Titre`=\"".$_GET['titre']."\" AND `Redacteur`=\"".$_GET['redacteur']."\";";
  			$res=mysqli_query($cid, $requete);
  			//Fin du SQL

  			//Si la requete echoue
  			if($res == FALSE) 
        		echo "ERREUR de requete";
  			//Si la requete renvoie un résultat...   
  			else
  			{
  				$nbre_res=mysqli_num_rows($res); 
  				if($nbre_res==0)
  					die("Vous n'avez écrit aucun billet.<br/>"); 
				
				$ligne = mysqli_fetch_assoc($res); 
				echo "<form method=\"post\" action=\"\">"; 
				echo "<legend> Billet ".$_GET['titre']." écrit par ".$_GET['redacteur']." </legend>"; 
   				echo "<label>Résumer</label>";
   				echo "<br/><textarea rows='10' cols='50' disabled='disabled'>".$ligne['Resumer']."</textarea>"; 
   				echo "<br/><label>Contenu</label>";
   				echo "<br/><textarea rows='30' cols='50' disabled='disabled'>".$ligne['Contenu']."</textarea><br/>";
   				echo "<input type=\"submit\" name=\"Envoyer\" value=\"Publié\"/>"; 
   				echo "<input type=\"submit\" name=\"retour\" value=\"Retour\"/>"; 
   				echo "</form>"; 
			}


			if(isset($_POST['retour']))
			{
				header("Location: ./page_perso.php"); 
			}
			
			elseif(isset($_POST['Envoyer']))
			{
				$requete="UPDATE `billet` SET `Etat` = 'Publie' WHERE `Titre` = '".$_GET['titre']."' AND `Redacteur` ='".$_GET['redacteur']."';"; 
				$res=mysqli_query($cid, $requete); 

				if($res == FALSE)
				{ 
					$_SESSION['publication_ok']=0; 
					echo "Erreur dans la publication."; 
				}
				else
				{
					$_SESSION['publication_ok']=1; 
					header("Location: ./moderer_billet.php"); 
				}
			}
		?>
	</BODY>
</HTML>
