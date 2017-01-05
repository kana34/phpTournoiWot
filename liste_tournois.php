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

mysql_select_db($database_tournoi, $tournoi);
$query_tournois = "SELECT * FROM tournois ORDER BY date_event ASC";
$tournois = mysql_query($query_tournois, $tournoi) or die(mysql_error());
$row_tournois = mysql_fetch_assoc($tournois);
$totalRows_tournois = mysql_num_rows($tournois);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Liste tournois</title>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<style type="text/css">
#tb {
	cursor: pointer;
}
#tb:hover {
	background-color:#CCC;
}
</style>
</head>

<body>
<table width="700" border="1" align="center">
  <tr>
        <td align="center">Nom du tournoi</td>
        <td align="center">Description</td>
        <td align="center">Nbr joueur par équipe</td>
        <td align="center">Nombre d'équipe</td>
        <td align="center">Date du tournoi</td>
    </tr>
    <?php do { ?>
      <tr onclick="MM_goToURL('parent','inscription.php?id=<?php echo $row_tournois['id']; ?>');return document.MM_returnValue" id="tb">
        <td align="center"><?php echo $row_tournois['nom']; ?></td>
        <td><?php echo $row_tournois['description']; ?></td>
        <td align="center"><?php echo $row_tournois['nbr_joueur']; ?></td>
        <td align="center"><?php echo $row_tournois['nbr_equipe']; ?></td>
        <td align="center"><?php echo $row_tournois['date_event']; ?> à <?php echo $row_tournois['heure_event']; ?></td>
      </tr>
      <?php } while ($row_tournois = mysql_fetch_assoc($tournois)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($tournois);
?>
