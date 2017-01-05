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

mysql_select_db($database_tournoi, $tournoi);
$query_info_tournoi = "SELECT * FROM tournois ORDER BY date_event ASC";
$info_tournoi = mysql_query($query_info_tournoi, $tournoi) or die(mysql_error());
$row_info_tournoi = mysql_fetch_assoc($info_tournoi);
$totalRows_info_tournoi = mysql_num_rows($info_tournoi);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Liste des tournois</title>
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
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Liste des tournois<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    <table border="1" align="center">
      <tr>
        <td align="center">Nom</td>
        <td align="center">Nbr<br /> joueur</td>
        <td align="center">Nbr<br /> equipe</td>
        <td align="center">Map</td>
        <td align="center">Date<br /> tournoi</td>
        <td align="center">Heure<br /> tournoi</td>
        <td align="center">Inscription<br /> ouvert</td>
        <td align="center">Joueur</td>
        <td align="center">Placement<br /> joueur</td>
        <td align="center">Modif</td>
        <td align="center">Supp</td>
      </tr>
      <?php do { ?>
        <tr>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['nom']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['nbr_joueur']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['nbr_equipe']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['map']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['date_event']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['heure_event']; ?></td>
          <td align="center" style="padding:5px;"><?php echo $row_info_tournoi['open']; ?></td>
          <td align="center" style="padding:5px;"><a href="joueur.php?id=<?php echo $row_info_tournoi['id']; ?>"><img src="../images/joueur.png" width="30" height="30" alt="joueur" /></a></td>
          <td align="center" style="padding:5px;"><a href="mise_en_place_joueur.php?id=<?php echo $row_info_tournoi['id']; ?>"><img src="../images/placement_joueur.png" width="60" height="30" /></a></td>
          <td align="center" style="padding:5px;"></td>
          <td align="center" style="padding:5px;"><a href="scripts/supprimer_tournoi.php?id=<?php echo $row_info_tournoi['id']; ?>"><img src="../images/supprimer.jpg" alt="supprimer" width="30" height="30" onclick="GP_popupConfirmMsg('Voulez vous supprimer ce tournoi ?');return document.MM_returnValue" /></a></td>
        </tr>
        <?php } while ($row_info_tournoi = mysql_fetch_assoc($info_tournoi)); ?>
    </table>
    <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($info_tournoi);
?>
