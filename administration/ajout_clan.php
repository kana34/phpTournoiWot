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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insert_clan")) {
  $insertSQL = sprintf("INSERT INTO clan (nom, id_clan) VALUES (%s, %s)",
                       GetSQLValueString($_POST['tag_clan'], "text"),
                       GetSQLValueString($_POST['id_clan'], "text"));

  mysql_select_db($database_tournoi, $tournoi);
  $Result1 = mysql_query($insertSQL, $tournoi) or die(mysql_error());

  $insertGoTo = "ajout_clan.php?ajoutclan=ok";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/page_administration.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ajouter un clan</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<link href="../css/form_universal.css" rel="stylesheet" type="text/css" />
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
    <h1><!-- InstanceBeginEditable name="Titre_page" -->Ajouter un clan<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenu_page" -->
    <?php
	if(!isset($_GET['clan'])){
    ?>
    
    <p>Pour ajouter un clan vous devez vous munir de son id.<br />
    ex:</p>
    
    <form class="universal" action="ajout_clan.php">
      <ol style="width:350px; margin-left:100px;">
        <li>
          <fieldset>
            <ol>
              <li>
                <label for="clan">Id du clan</label>
                <input type="text" id="clan" name="clan" value="" />
              </li>
            </ol>
          </fieldset>
        </li>
      </ol>
      <p style="text-align:right;">
        <input type="reset" value="CANCEL" />
        <input type="submit" value="OK" />
      </p>
    </form>
    <?php
	}
	else{

		$api_response = json_decode(file_get_contents("https://api.worldoftanks.eu/wgn/clans/info/?application_id=demo&clan_id=".$_GET['clan'].""), true);
		$tag_clan = $api_response["data"][$_GET['clan']]["tag"];
		echo $tag_clan;
	?>

    <iframe width="500" height="400" src="http://eu.wargaming.net/clans/wot/<?php echo $_GET['clan']; ?>" frameborder="0" scrolling="yes"></iframe>
    
    <form action="<?php echo $editFormAction; ?>" method="POST" name="insert_clan">
        <input name="id_clan" id="id_clan" type="hidden" value="<?php echo $_GET['clan']; ?>" />
        <input name="tag_clan" id="tag_clan" type="hidden" value="<?php echo $tag_clan; ?>" />
        <input name="submit" type="submit" value="Enregistrer le clan " />
        <input type="hidden" name="MM_insert" value="insert_clan" />
    </form>
    <?php
	}
    ?>

  <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>supprimer.</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
