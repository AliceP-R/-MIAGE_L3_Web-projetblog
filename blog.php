<?php 
	session_start(); 
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Accueil </TITLE>
	</HEAD>
	<BODY>
		<?php
		include("config.php"); 
		
		// Affichage des billets par 5 

		/*Connection a la base de données*/
      	$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
		
		//Début du SQL
		$limite=5*($_GET['page']-1); 
  		$requete = "SELECT `Titre`, `Resumer`, `Redacteur`, `date_creation` FROM `billet` WHERE `Etat`=\"Publie\" ORDER BY `date_creation` DESC LIMIT 5 OFFSET ".$limite.";";
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
  				die("Il n'y a aucun billet.<br/>"); 
  			
  			// Afficahge des billets 
  			echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Billets</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Date de création</TH><TH>Titre</TH><TH>Résumé</TH><TH>Redacteur</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
    			echo "<TD VALIGN=MIDDLE>".$ligne["date_creation"]."</TD>";
   				echo "<TD VALIGN=MIDDLE><a href=\"./affichage_1_billet.php?titre=".$ligne['Titre']."&redacteur=".$ligne['Redacteur']."\">".$ligne['Titre']."</a></TD>";
   				echo "<TD VALIGN=MIDDLE>".$ligne["Resumer"]."</TD>";
          		echo "<TD VALIGN=MIDDLE>".$ligne["Redacteur"]."</TD>";
   				echo "</TR>"; 
			}  
			echo "</TABLE>"; 
  				
        	mysqli_close ($cid);
		  }

		//Pagination
      	include("config.php"); 
      	/*Connection a la base de données*/
      	if(!($cid=mysqli_connect("localhost", $user,$password, "projet_blog")))
      	{
			die("Erreur de connexion à la base de données.<br/>");
      	}

      	//Debut du SQL
        $requete = "SELECT COUNT(*) FROM `billet` WHERE `Etat`=\"Publie\""; 
  		$res=mysqli_query($cid, $requete);
  		//Fin du SQL  
  			
  		//Si l'insertion a échoué => Message d'erreur
  		if($res == FALSE) 
  		{
  			die("Il y a une erreur de requête."); 
  		}
  		else
  		{
  			$nbre=mysqli_fetch_row($res); 
  			$nbre_ligne=$nbre[0]; 
  			$nbre_pagination=ceil($nbre_ligne/5); 
  			for($i=1; $i<=$nbre_pagination; $i++)
  			{
  				echo "<a href=\"./blog.php?page=".$i."\">".$i."</a>"; 
  				if($i != $nbre_pagination)
  				echo "-"; 
  			}
  		}

  		?>
  		<form method="POST" action="">
  		<?php if(isset($_SESSION['pseudo'])): ?>
			<input type="submit" name="page" value="Aller sur ma page"> 
		<?php endif; ?>
			<input type="submit" name="changement" value="Retour à l'accueil"> 
    	</form>
    	<?php 
    	if(isset($_POST['page']))
        	header("Location: ./page_perso.php"); 
        if(isset($_POST['changement']))
        	header("Location: ./accueil.php"); 
	    ?>
      </BODY>
  </HTML>