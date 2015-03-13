<?php session_start(); ?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Liste des articles </TITLE>
	</HEAD>

	<BODY>
		<?php
			include("config.php"); 
			// Récupération des articles de la personne connectée 
			/*Connection a la base de données*/
      		if(!($cid=mysql_connect("localhost", $user,$password)))
      		{
				die("Erreur de connexion à la base de données.<br/>");
      		}
			//Début du SQL
  			$requete = "SELECT `Titre`, `Resumer` FROM `billet` WHERE `Redacteur`='".$_SESSION['pseudo']."';";
  			mysql_select_db("projet_blog");
  			$res=mysql_query($requete, $cid);
  			//Fin du SQL
  
  			//Si la requete echoue
  			if($res == FALSE) 
    			echo "ERREUR de requete";
  
  			//Si la requete renvoie un résultat...   
  			else
  			{
  				$nbre_res=mysql_num_rows($res); 
  				if($nbre_res==0)
  					die("Vous n'avez écrit aucun article.<br/>"); 
    			
    			echo "<TABLE BORDER>"; 
    			echo "<CAPTION>Liste de mes billets</CAPTION>"; 
    			echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH></TR>"; 
    			while ($ligne = mysql_fetch_assoc($res)) 
    			{
    				echo "<TR ALIGN=CENTER>"; 
   					echo "<TD VALIGN=MIDDLE>".$ligne["Titre"]."</TD>";
   					echo "<TD VALIGN=MIDDLE>".$ligne["Resumer"]."</TD>";
   					echo "</TR>"; 
				}

				echo "</TABLE>"; 
			}
    			
		?>
	</BODY>
</HTML>