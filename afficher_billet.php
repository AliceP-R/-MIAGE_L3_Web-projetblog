<?php 
  session_start(); 
  var_dump($_SESSION); 

?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta charset="utf-8" />
		<TITLE> Liste des billets </TITLE>
	</HEAD>

	<BODY>
    <form method="POST" action="">
      <input type="submit" name="retour" value="Retour à ma page"> 
    </form>

		<?php

      if(isset($_POST['retour']))
        header("Location: ./page_perso.php"); 


			include("config.php"); 
			// Récupération des billets de la personne connectée 
			/*Connection a la base de données*/
      $cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
			//Début du SQL
  		$requete = "SELECT `Titre`, `Resumer`, `Etat` FROM `billet` WHERE `Redacteur`='".$_SESSION['pseudo']."';";
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
    		
    		echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Liste de mes billets</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH><TH>Etat</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE>".$ligne["Titre"]."</TD>";
   				echo "<TD VALIGN=MIDDLE>".$ligne["Resumer"]."</TD>";
          echo "<TD VALIGN=MIDDLE>".$ligne["Etat"]."</TD>";
   				echo "</TR>"; 
			  }  

			  echo "</TABLE>"; 
        mysqli_close ($cid);
		  }
    			
		?>
	</BODY>
</HTML>