<?php
/*
 * config.php
 * - error display
 * - database config
 * - database initial connection
 */

$team = 'Team 99';

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '1');

$mysql_host = '127.0.0.1';
$mysql_port = 3306;
$mysql_database = 'team1';
$mysql_username = 'team1';
$mysql_password = 'password';

$db = mysql_connect("$mysql_host:$mysql_port", $mysql_username, $mysql_password);
mysql_select_db($mysql_database);
