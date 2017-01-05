<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Accueil</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
<link href="../css/style_admin.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><a href="#"><img src="" alt="Insérer le logo ici" name="Insert_logo" width="180" height="90" id="Insert_logo" style="background-color: #C6D580; display:block;" /></a> 
    <!-- end .header --></div>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="ajout_clan.php">Ajouter un clan</a></li>
      <li><a href="liste_clan.php">Liste des clans</a></li>
      <li><a href="ajout_tournoi.php">Ajouter un tournoi</a></li>
      <li><a href="liste_tournois.php">Liste des tournois</a></li>
      <li><a href="#">Banlist</a></li>
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Accueil<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    <?php
		if($_GET['action'] == 'add_tournoi'){
			echo '<h3>Tournoi créé avec succés !</h3>';
		}
		else if($_GET['action'] == 'supp_tournoi'){
			echo '<h3>Tournoi suprimé avec succés !</h3>';
		}
	?>
    <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
