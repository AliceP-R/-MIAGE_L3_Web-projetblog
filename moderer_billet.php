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
		<TITLE> Modération des billets </TITLE>
	</HEAD>
	<BODY>
		<form method="POST" action="">
				<input type="submit" name="retour" value="Retour">
		</form>
		<?php

			if(isset($_POST['retour']))
			{
				header("Location: ./page_perso.php"); 
			}

			if($_SESSION['publication_ok']==1)
			{
				echo "<p>Le billet ".$_SESSION['titre']." a bien été publié.</p><br/>"; 
				$_SESSION['titre']=null; 
				$_SESSION['publication_ok']=0; 
			}
			// Récupération des données relatives au billet 
			include("config.php"); 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      		$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  			$requete = "SELECT `Titre`, `Resumer`, `Contenu`, `Redacteur` FROM `billet` WHERE `Etat`=\"En attente\";";
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
  					die("<p>Tous les billets sont publiés.</p><br/>"); 
				
				echo "<TABLE BORDER>"; 
    			echo "<CAPTION>Liste des billets non publiés</CAPTION>"; 
    			echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH><TH>Auteur</TH></TR>"; 
				while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE><a href=\"./changement_etat_billet.php?titre=".$ligne['Titre']."&redacteur=".$ligne['Redacteur']."\">".$ligne['Titre']."</a></TD>"; 
          		echo "<TD VALIGN=MIDDLE>".$ligne["Resumer"]."</TD>";
          		echo "<TD VALIGN=MIDDLE>".$ligne["Redacteur"]."</TD>";
   				echo "</TR>"; 
			  }  

				echo "</TABLE>"; 
    			
			}
			?>
	</BODY>
</HTML>
