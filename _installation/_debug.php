<?php

/**
 * This is a helper file that simply outputs the content of the users.db file.
 * Might be useful for your development.
 */

// error reporting config
error_reporting(E_ALL);

// config
$db_type = "sqlite";
$db_sqlite_path = "../users.db";

// create new database connection
$db_connection = new PDO($db_type . ':' . $db_sqlite_path);if(1==2){

// query
$sql = 'SELECT * FROM users';

// execute query
$query = $db_connection->prepare($sql);
$query->execute();

// show all the data from the "users" table inside the database
var_dump($query->fetchAll());}else{
	
	echo'<pre>';
	$stmt=$db_connection->query('SELECT name '
			.'FROM sqlite_master '
			."WHERE type='table' AND name !='' "
		);
	$count=0;
	while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
		$count++;
		echo"Table: ".$row['name']."<br>";
		// query
		$sql = 'SELECT * FROM ' . $row['name'] ;
		// execute query
		$query = $db_connection->prepare($sql);
		$query->execute();
		// show all the data from the "users" table inside the database
		print_r($query->fetchAll());
	}
	if(!$count )print_r(
		array(
			'info: no table',
			'do: install',
		)
	);
	echo'</pre>';
	
}


