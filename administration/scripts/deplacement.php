<?php require_once('../../Connections/tournoi.php'); ?>
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

$colname_deplacement = "-1";
if (isset($_GET['id'])) {
  $colname_deplacement = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_deplacement = sprintf("SELECT * FROM inscription WHERE id = %s", GetSQLValueString($colname_deplacement, "int"));
$deplacement = mysql_query($query_deplacement, $tournoi) or die(mysql_error());
$row_deplacement = mysql_fetch_assoc($deplacement);
$totalRows_deplacement = mysql_num_rows($deplacement);

// On met à jour
$updateSQL = sprintf("UPDATE inscription SET chiffre=%s WHERE id=%s",
				   GetSQLValueString('0', "int"),
				   GetSQLValueString($_GET['id'], "int"));

mysql_select_db($database_tournoi, $tournoi);
$Result1 = mysql_query($updateSQL, $tournoi) or die(mysql_error());

$updateGoTo = "../mise_en_place_joueur.php?id=".$row_deplacement['tournoi'];
header(sprintf("Location: %s", $updateGoTo));

mysql_free_result($deplacement);
?>