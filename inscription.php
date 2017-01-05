<?php require_once('Connections/tournoi.php'); ?>
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

$colname_info_tournoi = "-1";
if (isset($_GET['id'])) {
  $colname_info_tournoi = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_info_tournoi = sprintf("SELECT * FROM tournois WHERE id = %s", GetSQLValueString($colname_info_tournoi, "int"));
$info_tournoi = mysql_query($query_info_tournoi, $tournoi) or die(mysql_error());
$row_info_tournoi = mysql_fetch_assoc($info_tournoi);
$totalRows_info_tournoi = mysql_num_rows($info_tournoi);

// Récuperation des inscriptions
$colname_inscription = "-1";
if (isset($_GET['id'])) {
  $colname_inscription = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_inscription = sprintf("SELECT * FROM inscription WHERE tournoi = %s", GetSQLValueString($colname_inscription, "text"));
$inscription = mysql_query($query_inscription, $tournoi) or die(mysql_error());
$row_inscription = mysql_fetch_assoc($inscription);
$totalRows_inscription = mysql_num_rows($inscription);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscription</title>
</head>

<body>

<h2 style="text-align:center; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;">Information du tournoi<br /> <span style="color:#F60"><?php echo $row_info_tournoi['nom']; ?></span></h2>

<p style="text-align:center; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;"><?php echo $row_info_tournoi['description']; ?></p>

<table width="300px" border="1" align="center">
  <tr>
    <td>Date</td>
    <td><?php echo $row_info_tournoi['date_event']; ?> à <?php echo $row_info_tournoi['heure_event']; ?></td>
  </tr>
  <tr>
    <td>Place(s) retante(s)</td>
    <td><?php echo $totalRows_inscription;?>/<?php echo ($row_info_tournoi['nbr_joueur'] * $row_info_tournoi['nbr_equipe']); ?></td>
  </tr>
  <tr>
    <td>Clan(s) participant(s)</td>
    <td><?php echo $row_info_tournoi['id_clan1']; ?></td>
  </tr>
</table>

<h3 style="text-align:center; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;">Important</h3>

<p style="text-align:center; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;">Par respect des autres joueurs il est nécessaire d'être présent et à l'heure. Passer 15 minutes tous les joueurs absent seront déclarés vaincus.</p>



<form action="scripts/inscription_joueur.php" method="get" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pseudo:</td>
      <td><input type="text" name="pseudo" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insérer un enregistrement" /></td>
    </tr>
  </table>
  <input type="hidden" name="tournoi" value="<?php echo $row_info_tournoi['id']; ?>" />
  <input type="hidden" name="lettre" value="a" />
  <input type="hidden" name="id" value="<?php echo $row_info_tournoi['id']; ?>" />
  <input type="hidden" name="chiffre" value="0" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>

</body>
</html>