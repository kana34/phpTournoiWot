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

// Les informations du tournoi
// ---------------------------
$colname_info_tournoi = "-1";
if (isset($_GET['id'])) {
  $colname_info_tournoi = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_info_tournoi = sprintf("SELECT * FROM tournois WHERE id = %s", GetSQLValueString($colname_info_tournoi, "int"));
$info_tournoi = mysql_query($query_info_tournoi, $tournoi) or die(mysql_error());
$row_info_tournoi = mysql_fetch_assoc($info_tournoi);
$totalRows_info_tournoi = mysql_num_rows($info_tournoi);

// Les joueurs du tournoi
// ----------------------
$colname_joueurs = "-1";
if (isset($_GET['id'])) {
  $colname_joueurs = $_GET['id'];
}
mysql_select_db($database_tournoi, $tournoi);
$query_joueurs = sprintf("SELECT * FROM inscription WHERE chiffre = 0 AND tournoi = %s", GetSQLValueString($colname_joueurs, "text"));
$joueurs = mysql_query($query_joueurs, $tournoi) or die(mysql_error());
$row_joueurs = mysql_fetch_assoc($joueurs);
$totalRows_joueurs = mysql_num_rows($joueurs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Placement joueur</title>
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
      <li><a href="#">Aujouter un tournoi</a></li>
      <li><a href="#">Liste des tournois</a></li>
      <li><a href="#">Lien quatre</a></li>
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Mise en place des joueurs<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    
    <p>Mise en place des joueurs pour le torunoi "<?php echo $row_info_tournoi['nom']; ?>" du <?php echo $row_info_tournoi['date_event']; ?></p>
    
    <div id="joueur_attente">
		<?php do { ?>
        	<a href="scripts/placement.php?pseudo=<?php echo $row_joueurs['pseudo']; ?>&id=<?php echo $_GET['id'];?>">
				<?php echo $row_joueurs['pseudo']; ?> <span style="color:#060;">[<?php echo $row_joueurs['clan']; ?>]</span>
            </a><br />
        <?php } while ($row_joueurs = mysql_fetch_assoc($joueurs)); ?>
    </div>
    
    <div id="joueur_place">
		
		  <?php
        $nombre_equipe = 1;
        
        while ($nombre_equipe <= $row_info_tournoi['nbr_equipe'])
        {
			$colname_equipe = "-1";
			if (isset($nombre_equipe)) {
			  $colname_equipe = $nombre_equipe;
			}
			mysql_select_db($database_tournoi, $tournoi);
			$query_equipe = sprintf("SELECT * FROM inscription WHERE chiffre = %s", GetSQLValueString($colname_equipe, "int"));
			$equipe = mysql_query($query_equipe, $tournoi) or die(mysql_error());
			$row_equipe = mysql_fetch_assoc($equipe);
			$totalRows_equipe = mysql_num_rows($equipe);

			echo '<p>Equipe '.$nombre_equipe.'</p>',
				 '<div id="equipe">';
				 do {
				 echo $row_equipe['pseudo'].'<span style="color:#0C0;">['.$row_equipe['clan'].']</span>, ';
				 } while ($row_equipe = mysql_fetch_assoc($equipe));
			echo '</div>';
			$nombre_equipe = $nombre_equipe + 1;
        }
        ?>
    </div>
    <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($info_tournoi);

mysql_free_result($joueurs);

mysql_free_result($equipe);
?>
