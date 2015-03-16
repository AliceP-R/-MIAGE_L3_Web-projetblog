<?php 
  session_start(); 
  if(!isset($_SESSION['pseudo']))
    header("Location: ./connexion.php"); 

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
  		$requete = "SELECT `Titre`, `Resumer`, `Redacteur`, `Etat` FROM `billet`;";
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
    		
    		echo "<TABLE BORDER>"; 
    		echo "<CAPTION>Liste des billets</CAPTION>"; 
    		echo "<TR ALIGN=CENTER><TH>Titre</TH><TH>Résumé</TH><TH>Etat</TH></TR>"; 
    		while ($ligne = mysqli_fetch_assoc($res)) 
    		{
    			echo "<TR ALIGN=CENTER>"; 
   				echo "<TD VALIGN=MIDDLE "; 
          if($ligne['Redacteur']==$_SESSION['pseudo'])
            echo "BGCOLOR=\"#FF6633\""; 
          echo ">".$ligne["Titre"]."</TD>";
   				echo "<TD VALIGN=MIDDLE "; 
          if($ligne['Redacteur']==$_SESSION['pseudo'])
            echo "BGCOLOR=\"#FF6633\""; 
          echo ">".$ligne["Resumer"]."</TD>";
          echo "<TD VALIGN=MIDDLE "; 
          if($ligne['Redacteur']==$_SESSION['pseudo'])
            echo "BGCOLOR=\"#FF6633\""; 
          echo ">".$ligne["Etat"]."</TD>";
   				echo "</TR>"; 

			  }  

			  echo "</TABLE>"; 
        mysqli_close ($cid);
		  }
    			
		?>
	</BODY>
</HTML>