<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmation inscription</title>
</head>

<body>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'insciption_true'){
	echo '<p style="text-align:center; font-family:Georgia, \'Times New Roman\', Times, serif; font-style:italic; color:#0C0;">Vous êtes désormais inscrit au tournoi !</p>';
}
else if(isset($_GET['action']) && $_GET['action'] == 'insciption_false'){
	echo '<p style="text-align:center; font-family:Georgia, \'Times New Roman\', Times, serif; font-style:italic; color:#F00;">Vous ne pouvez pas participer à ce tournoi car votre clan ne fait pas partie des clans autorisés !</p>';
}
else if(isset($_GET['action']) && $_GET['action'] == 'insciption_false_pseudo'){
	echo '<p style="text-align:center; font-family:Georgia, \'Times New Roman\', Times, serif; font-style:italic; color:#F00;">Vous êtes déjà inscrit à ce tournoi !</p>';
}
?>
</body>
</html>