<?php
$dbServer = DB_SERVER;
$dbUser = DB_USER ;
$dbPass = DB_PASS ;
$dbName = DB_NAME ;

$flag = TRUE;
if( !$link = mysql_connect($dbServer,$dbUser,$dbPass)){
	$flag = FALSE;
}
else if(!mysql_select_db($dbName,$link)){
	$flag = FALSE;
}
else if(!mysql_set_charset('utf8',$link)){
		$flag = FALSE;
}

if($flag == FALSE ){
	die('database error');
}

