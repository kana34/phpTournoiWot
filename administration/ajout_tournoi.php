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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tournois (nom, `description`, nbr_joueur, nbr_equipe, `map`, date_event, heure_event, `open`, id_clan1, id_clan2, id_clan3, id_clan4, id_clan5, `date`, createur) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['nbr_joueur'], "text"),
                       GetSQLValueString($_POST['nbr_equipe'], "text"),
                       GetSQLValueString($_POST['map'], "text"),
                       GetSQLValueString($_POST['date_event'], "text"),
                       GetSQLValueString($_POST['heure_event'], "text"),
                       GetSQLValueString(isset($_POST['open']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['id_clan1'], "text"),
                       GetSQLValueString($_POST['id_clan2'], "text"),
                       GetSQLValueString($_POST['clan3'], "text"),
                       GetSQLValueString($_POST['clan4'], "text"),
                       GetSQLValueString($_POST['clan5'], "text"),
                       GetSQLValueString($_POST['date'], "text"),
                       GetSQLValueString($_POST['createur'], "text"));

  mysql_select_db($database_tournoi, $tournoi);
  $Result1 = mysql_query($insertSQL, $tournoi) or die(mysql_error());

  $insertGoTo = "accueil.php?action=add_tournoi";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

// Sélection clan 1
mysql_select_db($database_tournoi, $tournoi);
$query_clan = "SELECT * FROM clan ORDER BY nom ASC";
$clan = mysql_query($query_clan, $tournoi) or die(mysql_error());
$row_clan = mysql_fetch_assoc($clan);
$totalRows_clan = mysql_num_rows($clan);

// Sélection clan 2
mysql_select_db($database_tournoi, $tournoi);
$query_clan2 = "SELECT * FROM clan ORDER BY nom ASC";
$clan2 = mysql_query($query_clan2, $tournoi) or die(mysql_error());
$row_clan2 = mysql_fetch_assoc($clan2);
$totalRows_clan2 = mysql_num_rows($clan2);

// Sélection clan 3
mysql_select_db($database_tournoi, $tournoi);
$query_clan3 = "SELECT * FROM clan ORDER BY nom ASC";
$clan3 = mysql_query($query_clan3, $tournoi) or die(mysql_error());
$row_clan3 = mysql_fetch_assoc($clan3);
$totalRows_clan3 = mysql_num_rows($clan3);

// Sélection clan 4
mysql_select_db($database_tournoi, $tournoi);
$query_clan4 = "SELECT * FROM clan ORDER BY nom ASC";
$clan4 = mysql_query($query_clan4, $tournoi) or die(mysql_error());
$row_clan4 = mysql_fetch_assoc($clan4);
$totalRows_clan4 = mysql_num_rows($clan4);

// Sélection clan 5
mysql_select_db($database_tournoi, $tournoi);
$query_clan5 = "SELECT * FROM clan ORDER BY nom ASC";
$clan5 = mysql_query($query_clan5, $tournoi) or die(mysql_error());
$row_clan5 = mysql_fetch_assoc($clan5);
$totalRows_clan5 = mysql_num_rows($clan5);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Création d'un tournoi</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<link href="../css/form_fancy.css" rel="stylesheet" type="text/css" />
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
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Création d'un tournoi<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    <form class="fancy" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <ol>
        <li>
          <fieldset>
            <ol>
              <li>
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="" />
              </li>
              <li>
                <label for="description">Description</label>
                <textarea id="description" name="description" cols="50" rows="10"></textarea>
              </li>
              <li>
                <label for="nbr_joueur">Nombre de joueur par équipe</label>
                <select id="nbr_joueur" name="nbr_joueur">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                </select>
              </li>
              <li>
                <label for="nbr_equipe">Nombre d'équipe</label>
                <select id="nbr_equipe" name="nbr_equipe">
                  <option value="4">4</option>
                  <option value="8">8</option>
                  <option value="16">16</option>
                  <option value="32">32</option>
                  <option value="64">64</option>
                  <option value="128">128</option>
                </select>
              </li>
              <li>
              	<label for="map">Map</label>
                <select id="map" name="map">
                  <option value="Abbey">Abbey</option>
                  <option value="Cliff">Cliff</option>
                  <option value="Ensk">Ensk</option>
                  <option value="Fiery Salient">Fiery Salient</option>
                  <option value="Fisherman's Bay">Fisherman's Bay</option>
                  <option value="Fjords">Fjords</option>
                </select>
              </li>
              <li>
                <label for="date_event">Date du tournoi ex: 25/12/2016</label>
                <input type="text" id="date_event" name="date_event" value="" />
              </li>
              <li>
                <label for="heure_event">Heure du tournoi ex: 16:11</label>
                <input type="text" id="heure_event" name="heure_event" value="" />
              </li>
              <li>
                <label for="id_clan1">Clan 1</label>
                <select id="id_clan1" name="id_clan1">
                  <option value="00000000" >Aucun</option>
                  <?php do { ?>
                  <option value="<?php echo $row_clan['id_clan']?>" ><?php echo $row_clan['nom']?></option>
                  <?php } while ($row_clan = mysql_fetch_assoc($clan)); ?>
                </select>
              </li>
              <li>
                <label for="id_clan2">Clan 2</label>
                <select id="id_clan2" name="id_clan2">
                  <option value="00000000" >Aucun</option>
                  <?php do { ?>
                  <option value="<?php echo $row_clan2['id_clan']?>" ><?php echo $row_clan2['nom']?></option>
                  <?php } while ($row_clan2 = mysql_fetch_assoc($clan2)); ?>
                </select>
              </li>
              <li>
                <label for="clan3">Clan 3</label>
                <select id="clan3" name="clan3">
                  <option value="00000000" >Aucun</option>
                  <?php do { ?>
                  <option value="<?php echo $row_clan3['id_clan']?>" ><?php echo $row_clan3['nom']?></option>
                  <?php } while ($row_clan3 = mysql_fetch_assoc($clan3)); ?>
                </select>
              </li>
              <li>
                <label for="clan4">Clan 4</label>
                <select id="clan4" name="clan4">
                  <option value="00000000" >Aucun</option>
                  <?php do { ?>
                  <option value="<?php echo $row_clan4['id_clan']?>" ><?php echo $row_clan4['nom']?></option>
                  <?php } while ($row_clan4 = mysql_fetch_assoc($clan5)); ?>
                </select>
              </li>
              <li>
                <label for="clan5">Clan 5</label>
                <select id="clan5" name="clan5">
                  <option value="00000000" >Aucun</option>
                  <?php do { ?>
                  <option value="<?php echo $row_clan5['id_clan']?>" ><?php echo $row_clan5['nom']?></option>
                  <?php } while ($row_clan5 = mysql_fetch_assoc($clan5)); ?>
                </select>
              </li>
            </ol>
          </fieldset>
        </li>
      </ol>
      <p style="text-align:right;">
        <input type="hidden" name="date" value="<?php echo date("d-m-Y"); ?>" />
        <input type="hidden" name="createur" value="kana34" />
        <input type="hidden" name="MM_insert" value="form1" />
        <input type="reset" value="CANCEL" />
        <input type="submit" value="OK" />
      </p>
    </form>
    <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($clan);
mysql_free_result($clan2);
mysql_free_result($clan3);
mysql_free_result($clan4);
mysql_free_result($clan5);
?>
