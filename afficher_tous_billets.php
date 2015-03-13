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
  		$requete = "SELECT `Titre`, `Resumer`, `Redacteur` FROM `billet` WHERE `Etat`=\"Publie\";";
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
  				die("Il n'y a aucun billet publié.<br/>"); 
    		
    		echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Liste des billets publiés</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
          echo $ligne['Redacteur']; 
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE "; 
          if($ligne['Redacteur']==$_SESSION['pseudo'])
            echo "BGCOLOR=\"#FF6633\""; 
          echo ">".$ligne["Titre"]."</TD>";
   				echo "<TD VALIGN=MIDDLE "; 
          if($ligne['Redacteur']==$_SESSION['pseudo'])
            echo "BGCOLOR=\"#FF6633\""; 
          echo ">".$ligne["Resumer"]."</TD>";
   				echo "</TR>"; 
			  }  

			  echo "</TABLE>"; 
        mysqli_close ($cid);
		  }
    			
		?>
	</BODY>
</HTML>