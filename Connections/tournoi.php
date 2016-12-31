<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_tournoi = "localhost";
$database_tournoi = "tournois";
$username_tournoi = "root";
$password_tournoi = "";
$tournoi = mysql_pconnect($hostname_tournoi, $username_tournoi, $password_tournoi) or trigger_error(mysql_error(),E_USER_ERROR); 
?>