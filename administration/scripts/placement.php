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

// Les informations du tournoi
// ---------------------------
$colname_info_tournoi = "-1";
if (isset($_GET['id'])) {
  $colname_info_tournoi = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_info_tournoi = sprintf("SELECT nbr_joueur, nbr_equipe FROM tournois WHERE id = %s", GetSQLValueString($colname_info_tournoi, "int"));
$info_tournoi = mysql_query($query_info_tournoi, $tournoi) or die(mysql_error());
$row_info_tournoi = mysql_fetch_assoc($info_tournoi);
$totalRows_info_tournoi = mysql_num_rows($info_tournoi);

// Les informations du joueur
// --------------------------
$colname_joueur = "-1";
if (isset($_GET['pseudo'])) {
  $colname_joueur = $_GET['pseudo'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_joueur = sprintf("SELECT * FROM inscription WHERE pseudo = %s", GetSQLValueString($colname_joueur, "text"));
$joueur = mysql_query($query_joueur, $tournoi) or die(mysql_error());
$row_joueur = mysql_fetch_assoc($joueur);
$totalRows_joueur = mysql_num_rows($joueur);


$nombre_joueur_par_equipe = $row_info_tournoi['nbr_joueur'];
$nombre_equipe = 1;

while ($nombre_equipe <= $row_info_tournoi['nbr_equipe'])
{
	$colname_nbr_joueur_equipe = "-1";
	if (isset($nombre_equipe)) {
	  $colname_nbr_joueur_equipe = $nombre_equipe;
	}
	mysql_select_db($database_tournoi, $tournoi);
	$query_nbr_joueur_equipe = sprintf("SELECT * FROM inscription WHERE chiffre = %s", GetSQLValueString($colname_nbr_joueur_equipe, "int"));
	$nbr_joueur_equipe = mysql_query($query_nbr_joueur_equipe, $tournoi) or die(mysql_error());
	$row_nbr_joueur_equipe = mysql_fetch_assoc($nbr_joueur_equipe);
	$totalRows_nbr_joueur_equipe = mysql_num_rows($nbr_joueur_equipe);
	
	if($nombre_joueur_par_equipe > $totalRows_nbr_joueur_equipe){
		
		// Enregistrement de la position du joueur
		// ---------------------------------------
		$updateSQL = sprintf("UPDATE inscription SET lettre=%s, chiffre=%s WHERE id=%s",
                       GetSQLValueString("a", "text"),
                       GetSQLValueString($nombre_equipe, "int"),
                       GetSQLValueString($row_joueur['id'], "int"));
		
		mysql_select_db($database_tournoi, $tournoi);
		$Result1 = mysql_query($updateSQL, $tournoi) or die(mysql_error());
		
		$nombre_equipe = $row_info_tournoi['nbr_equipe'] + 1;
		
		$updateGoTo = "../mise_en_place_joueur.php";
		if (isset($_SERVER['QUERY_STRING'])) {
		$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}
	else{
		$nombre_equipe = $nombre_equipe + 1;
	}	
}

mysql_free_result($info_tournoi);
mysql_free_result($nbr_joueur_equipe);
mysql_free_result($joueur);
?>