<link href="../css/tableau.css" rel="stylesheet" type="text/css">
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

$colname_joueur = "-1";
if (isset($_GET['id'])) {
  $colname_joueur = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_joueur = sprintf("SELECT * FROM inscription WHERE tournoi = %s", GetSQLValueString($colname_joueur, "text"));
$joueur = mysql_query($query_joueur, $tournoi) or die(mysql_error());
$row_joueur = mysql_fetch_assoc($joueur);
$totalRows_joueur = mysql_num_rows($joueur);



mysql_free_result($joueur);
?>
