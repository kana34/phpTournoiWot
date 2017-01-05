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

$idtournoi = $_GET['id'];

$colname_info_tournoi = "-1";
if (isset($idtournoi)) {
  $colname_info_tournoi = $idtournoi;
}
mysql_select_db($database_tournoi, $tournoi);
$query_info_tournoi = sprintf("SELECT * FROM tournois WHERE id = %s", GetSQLValueString($colname_info_tournoi, "int"));
$info_tournoi = mysql_query($query_info_tournoi, $tournoi) or die(mysql_error());
$row_info_tournoi = mysql_fetch_assoc($info_tournoi);
$totalRows_info_tournoi = mysql_num_rows($info_tournoi);

// Récuperation des inscriptions
$colname_inscription = "-1";
if (isset($idtournoi)) {
  $colname_inscription = $idtournoi;
}
mysql_select_db($database_tournoi, $tournoi);
$query_inscription = sprintf("SELECT * FROM inscription WHERE tournoi = %s", GetSQLValueString($colname_inscription, "text"));
$inscription = mysql_query($query_inscription, $tournoi) or die(mysql_error());
$row_inscription = mysql_fetch_assoc($inscription);
$totalRows_inscription = mysql_num_rows($inscription);

// Vérification inscription
$colname_verif_inscription = "-1";
if (isset($_GET['pseudo'])) {
  $colname_verif_inscription = $_GET['pseudo'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_verif_inscription = sprintf("SELECT * FROM inscription WHERE tournoi = 5 AND pseudo = %s", GetSQLValueString($colname_verif_inscription, "text"));
$verif_inscription = mysql_query($query_verif_inscription, $tournoi) or die(mysql_error());
$row_verif_inscription = mysql_fetch_assoc($verif_inscription);
$totalRows_verif_inscription = mysql_num_rows($verif_inscription);

// Récuparation de l'id du joueur
$api_adresse = "https://api.worldoftanks.eu/wgn/account/list/?application_id=demo&search=".$_GET['pseudo'];
$api_response = json_decode(file_get_contents($api_adresse), true);
$id_player = $api_response["data"]["0"]["account_id"];

// Récuperation de l'id du clan
$api_adresse2 = "https://api.worldoftanks.eu/wgn/clans/membersinfo/?application_id=demo&account_id=".$id_player;
$api_response2 = json_decode(file_get_contents($api_adresse2), true);
$id_clan = $api_response2["data"][$id_player]["clan"]["clan_id"];
if($id_clan == NULL){
	$id_clan = 1;
}
// On vérifie si le joueur est déjà inscrit
if($totalRows_verif_inscription == 1){
	$insertGoTo = "../inscription_confirmation.php?action=insciption_false_pseudo";
	header(sprintf("Location: %s", $insertGoTo));
	exit();
}

// On verifie si le joueur fait partie d'un clan
if($id_clan == $row_info_tournoi['id_clan1'] || $id_clan == $row_info_tournoi['id_clan2'] || $id_clan == $row_info_tournoi['id_clan3'] || $id_clan == $row_info_tournoi['id_clan4'] || $id_clan == $row_info_tournoi['id_clan5']){
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	
	if ((isset($_GET["MM_insert"])) && ($_GET["MM_insert"] == "form1")) {
		
	$insertSQL = sprintf("INSERT INTO inscription (pseudo, clan, tournoi, lettre, chiffre) VALUES (%s, %s, %s, %s, %s)",
							   GetSQLValueString($_GET['pseudo'], "text"),
							   GetSQLValueString($id_clan, "text"),
							   GetSQLValueString($_GET['tournoi'], "text"),
							   GetSQLValueString($_GET['lettre'], "text"),
							   GetSQLValueString($_GET['chiffre'], "int"));
	
			mysql_select_db($database_tournoi, $tournoi);
			$Result1 = mysql_query($insertSQL, $tournoi) or die(mysql_error());
	
			$insertGoTo = "../inscription_confirmation.php?action=insciption_true";
			if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
			}
			header(sprintf("Location: %s", $insertGoTo));
	}
}
else{
	$insertGoTo = "../inscription_confirmation.php?action=insciption_false";
	header(sprintf("Location: %s", $insertGoTo));
}

mysql_free_result($info_tournoi);
mysql_free_result($inscription);
mysql_free_result($verif_inscription);		
?>