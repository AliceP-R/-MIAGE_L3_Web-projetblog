<?php 
	session_start(); 
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE> Liste des commentaires </TITLE>
		<meta charset="utf-8">
	</HEAD>
	<BODY>
		<?php

		if(isset($_SESSION['ajout_com']))
		{
			echo "Votre commentaire a bien été pris en compte.<br/>"; 
			if($_SESSION['Droit'] !='Admin')
				echo "Il est en attente de validation."; 
			$_SESSION['ajout_com']=null; 
		}
		include("config.php"); 
		
		// Affichage des billets par 5 

		/*Connection a la base de données*/
    	$cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
		
		//Début du SQL
  		$requete = "SELECT `Emetteur`,`Contenu`,`date_ajout` FROM `commentaire` WHERE `Etat`='Publie' AND `Billet`=".$_GET['billet']." ORDER BY `date_ajout` DESC;"; 
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
  				die("Il n'y a aucun commentaire sur cette article.<br/>"); 
  			
  			// Afficahge des commentaires 
  			echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Commentaires</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Date d'ajout</TH><TH>Emetteur</TH><TH>Contenu</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
    			echo "<TD VALIGN=MIDDLE>".$ligne["date_ajout"]."</TD>";
   				echo "<TD VALIGN=MIDDLE>".$ligne['Emetteur']."</TD>";
   				echo "<TD VALIGN=MIDDLE>".$ligne["Contenu"]."</TD>";
   				echo "</TR>"; 
			}  
			echo "</TABLE>"; 
        	mysqli_close ($cid);
		  }
		  ?>

		  <form method="POST" action="">
  			<?php if(isset($_SESSION['pseudo'])): ?>
				<input type="submit" name="page" value="Aller sur ma page"> 
			<?php endif; ?>
				<input type="submit" name="changement" value="Retour"> 
				<input type="submit" name="commenter" value="Ajouter un commentaire"> 
    	</form>
    	<?php 
    		if(isset($_POST['page']))
        		header("Location: ./page_perso.php"); 
        	if(isset($_POST['changement']))
        		header("Location: ./blog.php?page=".$_SESSION['page']); 
        	if(isset($_POST['commenter']))
        		header("Location: ./ajout_commentaire.php?billet=".$_GET['billet']); 
        		
  		?>
	</BODY>
</HEAD>