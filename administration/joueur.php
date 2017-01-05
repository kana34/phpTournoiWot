<?php require_once('../Connections/tournoi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_liste_joueurs = "-1";
if (isset($_GET['id'])) {
  $colname_liste_joueurs = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_liste_joueurs = sprintf("SELECT * FROM inscription WHERE tournoi = %s ORDER BY pseudo ASC", GetSQLValueString($colname_liste_joueurs, "text"));
$liste_joueurs = mysql_query($query_liste_joueurs, $tournoi) or die(mysql_error());
$row_liste_joueurs = mysql_fetch_assoc($liste_joueurs);
$totalRows_liste_joueurs = mysql_num_rows($liste_joueurs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Joueur</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
</script>
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
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Joueur du tournoi<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    <table border="1" align="center" width="300px">
      <tr>
        <td align="center">Pseudo</td>
        <td align="center">Clan</td>
        <td align="center">Supp</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_liste_joueurs['pseudo']; ?></td>
          <td><?php echo $row_liste_joueurs['clan']; ?></td>
          <td align="center"><a href="scripts/supprimer_joueur.php?idjoueur=<?php echo $row_liste_joueurs['id']; ?>&id=<?php echo $_GET['id']; ?>"><img src="../images/supprimer.jpg" alt="supprimer" width="30" height="30" onclick="GP_popupConfirmMsg('Voulez vous supprimer ce joueur ?');return document.MM_returnValue" /></a></td>
        </tr>
        <?php } while ($row_liste_joueurs = mysql_fetch_assoc($liste_joueurs)); ?>
    </table>
    <!-- InstanceEndEditable -->
    <!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($liste_joueurs);
?>
