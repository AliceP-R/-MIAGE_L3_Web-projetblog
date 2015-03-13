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
      $cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  		$requete = "SELECT `Titre`, `Resumer` FROM `billet` WHERE `Redacteur`='".$_SESSION['pseudo']."';";
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
  				die("Vous n'avez écrit aucun article.<br/>"); 
    		
    		echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Liste de mes billets</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE>".$ligne["Titre"]."</TD>";
   				echo "<TD VALIGN=MIDDLE>".$ligne["Resumer"]."</TD>";
   				echo "</TR>"; 
			  }  

			  echo "</TABLE>"; 
        mysqli_close ($cid);
		  }
    			
		?>
	</BODY>
</HTML>