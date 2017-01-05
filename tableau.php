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

$width_body = ($row_info_tournoi['nbr_equipe'] * 120) + ((30 * $row_info_tournoi['nbr_equipe']) + 25);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tableau tournoi</title>
<link href="css/tableau.css" rel="stylesheet" type="text/css" />
</head>

<body style="width:<?php echo $width_body ;?>px; margin:auto;">
<div id="marge">
</div>

<div id="a">

<?php
$nbr_equipe_total = $row_info_tournoi['nbr_equipe'];
$num_equipe = 1;

while ($num_equipe <= $nbr_equipe_total){
	
	$colname_joueur = "-1";
	if (isset($_GET['id'])){
	$colname_joueur = $_GET['id'];
	}
	mysql_select_db($database_tournoi, $tournoi);
	$query_joueur = sprintf("SELECT * FROM inscription WHERE lettre = 'a' AND chiffre = ".$num_equipe." AND tournoi = %s", GetSQLValueString($colname_joueur, "text"));
	$joueur = mysql_query($query_joueur, $tournoi) or die(mysql_error());
	$row_joueur = mysql_fetch_assoc($joueur);
	$totalRows_joueur = mysql_num_rows($joueur);
	
	echo '<a href="#">';
	do {
		echo $row_joueur['pseudo'];
	} while ($row_joueur = mysql_fetch_assoc($joueur));
	echo '</a>';

	$num_equipe++; // $nombre_de_lignes = $nombre_de_lignes + 1
}
?>
</div>
<p>&nbsp;</p>
<div id="lien_a">
</div>

<div id="b">
<?php
$nbr_equipe2_total = $row_info_tournoi['nbr_equipe'];
$num_equipe2 = 1;

while ($num_equipe2 <= $nbr_equipe2_total){
	
	$colname_joueur2 = "-1";
	if (isset($_GET['id'])){
	$colname_joueur2 = $_GET['id'];
	}
	mysql_select_db($database_tournoi, $tournoi);
	$query_joueur2 = sprintf("SELECT * FROM inscription WHERE lettre = 'b' AND chiffre = ".$num_equipe2." AND tournoi = %s", GetSQLValueString($colname_joueur2, "text"));
	$joueur2 = mysql_query($query_joueur2, $tournoi) or die(mysql_error());
	$row_joueur2 = mysql_fetch_assoc($joueur2);
	$totalRows_joueur2 = mysql_num_rows($joueur2);
	
	if($totalRows_joueur2 == 0){
		$num_equipe2++;
	}
	else{
		echo '<a href="#">';
		do {
			echo $row_joueur2['pseudo'];
		} while ($row_joueur2 = mysql_fetch_assoc($joueur2));
		echo '</a>';
	
		$num_equipe2++; // $nombre_de_lignes = $nombre_de_lignes + 1
	}
}
?>
</div>
<p>&nbsp;</p>
<div id="lien_b">
</div>

<div id="c">
<?php
$nbr_equipe3_total = $row_info_tournoi['nbr_equipe'];
$num_equipe3 = 1;

while ($num_equipe3 <= $nbr_equipe3_total){
	
	$colname_joueur3 = "-1";
	if (isset($_GET['id'])){
	$colname_joueur3 = $_GET['id'];
	}
	mysql_select_db($database_tournoi, $tournoi);
	$query_joueur3 = sprintf("SELECT * FROM inscription WHERE lettre = 'c' AND chiffre = ".$num_equipe3." AND tournoi = %s", GetSQLValueString($colname_joueur3, "text"));
	$joueur3 = mysql_query($query_joueur3, $tournoi) or die(mysql_error());
	$row_joueur3 = mysql_fetch_assoc($joueur3);
	$totalRows_joueur3 = mysql_num_rows($joueur3);
	
	if($totalRows_joueur3 == 0){
		$num_equipe3++;
	}
	else{
		echo '<a href="#">';
		do {
			echo $row_joueur3['pseudo'];
		} while ($row_joueur3 = mysql_fetch_assoc($joueur2));
		echo '</a>';
	
		$num_equipe3++; // $nombre_de_lignes = $nombre_de_lignes + 1
	}
}
?>
</div>

<p>&nbsp;</p>

<div id="lien_c">
</div>

<div id="d">
<?php
$nbr_equipe4_total = $row_info_tournoi['nbr_equipe'];
$num_equipe4 = 1;

while ($num_equipe4 <= $nbr_equipe4_total){
	
	$colname_joueur4 = "-1";
	if (isset($_GET['id'])){
	$colname_joueur4 = $_GET['id'];
	}
	mysql_select_db($database_tournoi, $tournoi);
	$query_joueur4 = sprintf("SELECT * FROM inscription WHERE lettre = 'd' AND chiffre = ".$num_equipe4." AND tournoi = %s", GetSQLValueString($colname_joueur4, "text"));
	$joueur4 = mysql_query($query_joueur4, $tournoi) or die(mysql_error());
	$row_joueur4 = mysql_fetch_assoc($joueur4);
	$totalRows_joueur4 = mysql_num_rows($joueur4);
	
	if($totalRows_joueur4 == 0){
		$num_equipe4++;
	}
	else{
		echo '<a href="#">';
		do {
			echo $row_joueur4['pseudo'];
		} while ($row_joueur4 = mysql_fetch_assoc($joueur2));
		echo '</a>';
	
		$num_equipe4++; // $nombre_de_lignes = $nombre_de_lignes + 1
	}
}
?>
</div>

</body>
</html>
<?php
mysql_free_result($info_tournoi);
mysql_free_result($joueur);
mysql_free_result($joueur2);
mysql_free_result($joueur3);
mysql_free_result($joueur4);
?>
