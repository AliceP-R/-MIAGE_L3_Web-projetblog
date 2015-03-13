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
		<TITLE> Modification du billet </TITLE>
	</HEAD>
	<BODY>
		<?php

			$_SESSION['titre']=$_GET['titre']; 

			if($_GET['etat']=="Publie")
			{
				echo "Attention, si vous modifié cet article, il ne sera plus visible et devra être modérer par un administrateur avant d'être republié.</br>"; 
			}

			// Récupération des données relatives au billet 
			include("config.php"); 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      		$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  			$requete = "SELECT `Resumer`, `Contenu` FROM `billet` WHERE `Titre`=\"".$_GET['titre']."\" AND `Redacteur`=\"".$_SESSION['pseudo']."\";";
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
    			$_SESSION['resumer']=$ligne['Resumer']; 
    			$_SESSION['contenu']=$ligne['Contenu']; 

    			echo "<form method=\"POST\" action=\"\">"; 
				echo "<label for=\"titre\">Titre de votre billet</label><br />"; 
				echo "<input type=\"text\" name=\"titre\" value=\"".$_SESSION['titre']."\"><br/>"; 
				echo "<label for=\"titre\">Résumer de votre billet</label><br />"; 
				echo "<textarea name=\"resumer\" rows=\"10\" cols=\"50\">".$_SESSION['resumer']."</textarea><br/>";
				echo "<label for=\"titre\">Contenu de votre billet</label><br />"; 
				echo "<textarea name=\"contenu\" rows=\"30\" cols=\"50\">".$_SESSION['contenu']."</textarea><br/>"; 
				echo "<input type=\"submit\" name=\"Envoyer\" value=\"Modification terminée\"> "; 
				echo "<input type=\"submit\" name=\"retour\" value=\"Annuler la modification\">"; 
				echo "</form>"; 
			}

			if(isset($_POST['retour']))
			{
				header("Location: ./page_perso.php"); 
			}
			elseif(isset($_POST['Envoyer']))
			{
				$requete="UPDATE `billet` SET `Titre` = '".$_POST['titre']."', `Resumer`='".$_POST['resumer']."', `Contenu` = '".$_POST['contenu']."', `Etat` = 'En attente'
							 WHERE `Titre` = '".$_GET['titre']."' AND `Redacteur` ='".$_SESSION['pseudo']."';"; 
				$res=mysqli_query($cid, $requete); 

				if($res == FALSE)
				{
					$_SESSION['titre']=$_POST['Titre']; 
					$_SESSION['resumer']=$_POST['Resumer']; 
					$_SESSION['contenu']=$_POST['Contenu']; 
					$_SESSION['modif_ok']=0; 
					header("Location: ./modif_1_billet.php?titre=".$_POST['Titre']."&etat=".$_GET['Etat']); 
				}
				else
				{
					$_SESSION['modif_ok']=1; 
					header("Location: ./modification_billet.php"); 
				}
			}
		?>
	</BODY>
</HTML>
