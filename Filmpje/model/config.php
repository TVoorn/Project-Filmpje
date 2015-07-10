<?php

//defineren wat belangrijk is
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'filmpje');
define('TABLE_PREFIX', '');

define('WB_PATH', dirname(__FILE__));
define('WB_URL', 'http://localhost/Filmpje');

//verbinden met de db
$dbhandle = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) 
  or die("Unable to connect to MySQL");
//als verbinding met db is gemaakt selecteren we de database
mysql_select_db(DB_NAME,$dbhandle) 
  or die("Could not select databse");

ini_set("SMTP","mail.zeelandenet.nl");

?>