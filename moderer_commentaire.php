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
		<TITLE> Modération des commentaires </TITLE>
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

			if($_SESSION['commentaire_ok']==1)
			{
				echo "Le commentaire concernant le billet \"".$_SESSION['titre']."\" a bien été publié."; 
				$_SESSION['titre']=null; 
				$_SESSION['commentaire_ok']=0; 
			}
			if(isset($_SESSION['commentaire_supprime']))
			{
				echo "Le commentaire concernant le billet \"".$_SESSION['titre']."\" a bien été supprimé."; 
			}
			// Récupération des données relatives au billet 
			include("config.php"); 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      		$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
			$requete = "SELECT `commentaire`.`ID`, `Titre`, `Redacteur`, `commentaire`.`Contenu`, `Emetteur` FROM `commentaire`, `billet` WHERE `commentaire`.`Etat`=\"En attente\" AND `commentaire`.`Billet`=`billet`.`ID`;"; 
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
  					die("Tous les commentaires sont publiés.<br/>"); 
				
				echo "<TABLE BORDER>"; 
    			echo "<CAPTION>Liste des commentaires non publiés</CAPTION>"; 
    			echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Redacteur</TH><TH>Contenu</TH><TH>Emetteur</TH></TR>"; 
    			
				while ($ligne = mysqli_fetch_assoc($res)) 
    			{
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE><a href=\"./affichage_1_billet.php?titre=".$ligne['Titre']."&redacteur=".$ligne['Redacteur']."\">".$ligne['Titre']."</a></TD>"; 
          		echo "<TD VALIGN=MIDDLE>".$ligne["Redacteur"]."</TD>";
          		echo "<TD VALIGN=MIDDLE><a href=\"./changement_etat_commentaire.php?titre=".$ligne['Titre']."&id=".$ligne["ID"]."\">".$ligne["Contenu"]."</a></TD>";
          		echo "<TD VALIGN=MIDDLE>".$ligne["Emetteur"]."</TD>";
   				echo "</TR>"; 
			  }  

				echo "</TABLE>"; 
    			
			}
			?>
	</BODY>
</HTML>
