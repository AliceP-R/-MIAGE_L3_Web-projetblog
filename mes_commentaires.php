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
    <TITLE> Liste des commentaires </TITLE>
  </HEAD>

  <BODY>
    <form method="POST" action="">
      <input type="submit" name="retour" value="Retour à ma page"> 
    </form>

    <?php

      if(isset($_POST['retour']))
        header("Location: ./page_perso.php"); 


      echo "<TABLE BORDER>"; 
      echo "<CAPTION>Liste de mes commentaires</CAPTION>"; 
      echo "<TR ALIGN=CENTER><TH>Date</TH><TH>Contenu</TH><TH>Billet</TH><TH>Etat</TH></TR>"; 

      include("config.php"); 
      // Récupération des billets de la personne connectée 
      /*Connection a la base de données*/
      $cid = mysqli_connect("localhost", $user, $password, "projet_blog") or die("Erreur : ".mysqli_error($cid)); 
      //Début du SQL
      $requete = "SELECT billet.ID, billet.Titre, commentaire.Contenu, commentaire.Etat, commentaire.date_ajout FROM billet, commentaire WHERE commentaire.Emetteur='".$_SESSION['pseudo']."' AND billet.ID=commentaire.Billet ORDER BY commentaire.date_ajout ASC;";
      $res=mysqli_query($cid, $requete);
      //Fin du SQL
      
      if($res == FALSE)
        die("Erreur de requete id :".$requete); 
      else
      {   
        while($ligne=mysqli_fetch_assoc($res)) 
        {
          echo "<TR ALIGN=CENTER>"; 
          echo "<TD VALIGN=MIDDLE>".$ligne['date_ajout']."</TD>";
          echo "<TD VALIGN=MIDDLE>".$ligne["Contenu"]."</TD>";
          echo "<TD VALIGN=MIDDLE>".$ligne["Titre"]."</TD>";
          echo "<TD VALIGN=MIDDLE>".$ligne["Etat"]."</TD>";
          echo "</TR>"; 
        }  

        echo "</TABLE>"; 
      }
      mysqli_close ($cid);     
    ?>
  </BODY>
</HTML>