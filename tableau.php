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

$width_body = ($row_info_tournoi['nbr_equipe'] * 200) + (50 * ($row_info_tournoi['nbr_equipe'] + 1));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tableau tournoi</title>
<link href="css/tableau.css" rel="stylesheet" type="text/css" />
</head>

<body style="width:<?php echo $width_body ;?>px; margin:auto;">

<div id="a">

	  <?php
    $nbr_equipe_total = $row_info_tournoi['nbr_equipe'];
	$nombre_equipe = 1;

	while ($nombre_equipe <= $nbr_equipe_total)
	{
		$colname_joueur = "-1";
if (isset($_GET['id'])) {
  $colname_joueur = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_joueur = sprintf("SELECT * FROM inscription WHERE lettre = 'a' AND chiffre = ".$nombre_equipe." AND tournoi = %s", GetSQLValueString($colname_joueur, "text"));
$joueur = mysql_query($query_joueur, $tournoi) or die(mysql_error());
$row_joueur = mysql_fetch_assoc($joueur);
$totalRows_joueur = mysql_num_rows($joueur);
		
		echo '<a href="#">';
			 do {
			 	echo $row_joueur['pseudo'];
			 } while ($row_joueur = mysql_fetch_assoc($joueur));
	 	echo '</a>';
		
		$nombre_equipe++; // $nombre_de_lignes = $nombre_de_lignes + 1
	}
	?>
	  <?php echo $width_body; ?>
</div>
<p>&nbsp;</p>
<div id="lien_a">
</div>

<div id="b">

</div>

</body>
</html>
<?php
mysql_free_result($info_tournoi);

mysql_free_result($joueur);
?>
