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
		<TITLE> Page de <?php echo $_SESSION['pseudo'];?> </TITLE>
	</HEAD>
	<BODY>
		<p>Bonjour <?php echo $_SESSION['pseudo']; ?> !</p>
		<?php 
			if($_SESSION["juste_inscrit"]==1)
			{
				echo "<p>Votre inscription a bien été prise en compte, bienvenue sur notre site !</p>"; 
				$_SESSION["juste_inscrit"]=0; 
			}
		?>
		<p>Que voulez vous faire aujourd'hui ? </p>
		<form method="POST" action="">
			<input type="submit" name="bouton_creer" value="Créer un billet" />
			<input type="submit" name="bouton_modifier" value="Modifier un billet" />
			<input type="submit" name="bouton_voir" value="Voir mes billets" />
      <input type="submit" name="bouton_com" value="Voir mes commentaires" />
			<input type="submit" name="acces_blog" value="Accéder au blog" />
			<?php
			include("config.php"); 
				// Verification des droits de la personne connectée 
				/*Connection a la base de données*/
      			if(!($cid=mysqli_connect("localhost", $user,$password, "projet_blog")))
      			{
					die("Erreur de connexion à la base de données.<br/>");
      			}
      			
      			$requete = "SELECT `Droit` FROM `utilisateur` WHERE `login`=\"".$_SESSION['pseudo']."\";";
      			$res=mysqli_query($cid, $requete);

      			//Si la requete echoue
  				if($res == FALSE) 
    				echo "ERREUR de requete";
  
  				//Si la requete renvoie un résultat...   
  				else
  				{
    				//..on le stock dans $arr...
    				$arr=mysqli_fetch_assoc($res);
    				if($arr['Droit']=="Admin")
    				{
    					  echo '<input type="submit" name="tout_afficher" value="Afficher tous les billets" />'; 
      					echo '<input type="submit" name="moderer_billet" value="Modérer les billets" />'; 
      					echo '<input type="submit" name="moderer_commentaire" value="Modérer les commentaires" />'; 
      				}
  				}
  				
			?>
			<input type="submit" name="deconnexion" value="Se déconnecter" />
		</form>
		<?php 
			if($_SESSION['billet_soumis']==1 && $_SESSION['Droit']=="Lambda")
			{
				echo "<p>Votre billet \"".$_SESSION['titre']."\" a bien été soumis à modération, il sera publié dans les plus brefs délais.</p><br/>"; 
			}
			$_SESSION['titre']=null; 
			$_SESSION['resumer']=null; 
			$_SESSION['contenu']=null; 
			$_SESSION['actualisation']=0; 
			$_SESSION['billet_soumis']=0;
      $_SESSION['publication_ok']=0; 
      $_SESSION['commentaire_ok']=0; 


			// gestion des boutons

    		if(isset($_POST['bouton_creer']))
    		{
      			header("Location: ./creation_billet.php"); 
      		}
      		elseif(isset($_POST['bouton_modifier']))
      		{
      			header("Location: ./modification_billet.php"); 
      		}
      		elseif(isset($_POST['bouton_voir']))
      		{
      			header("Location: ./afficher_billet.php"); 
      		}
          elseif(isset($_POST['bouton_com']))
          {
            header("Location: ./mes_commentaires.php"); 
          }
      		elseif(isset($_POST['tout_afficher']))
      		{
      			header("Location: ./afficher_tous_billets.php"); 
      		}
          elseif(isset($_POST['moderer_billet']))
          {
            header("Location: ./moderer_billet.php"); 
          }
          elseif(isset($_POST['moderer_commentaire']))
          {
            header("Location: ./moderer_commentaire.php"); 
          }
			    elseif(isset($_POST['acces_blog']))
      		{
      			header("Location: ./blog.php?page=1");
      		}
      		elseif(isset($_POST['deconnexion']))
      		{
      			session_destroy(); 
      			header("Location: ./accueil.php"); 
      		}
		?>
	</BODY>
</HEAD>