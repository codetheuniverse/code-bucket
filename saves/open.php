<?php
	// Setup variables
	$filename = $_POST['filename'];

	// Setup database connection
	$dbname='../cb1856.db';
	$mytable ="file_store";
	$base=new SQLite3($dbname);

	// Do the query
	$query = "SELECT * FROM $mytable WHERE ID = $filename";
	$results = $base->query($query);
	$row = $results->fetchArray();
	if(count($row) > 0) {
			$data['error'] = false;
			$data['extension'] = $row['code_extension'];
			$data['author'] = $row['code_author'];
			$data['title'] = $row['code_title'];
			$data['key'] = $row['code_password'];
			$data['content'] = file_get_contents($filename . ".code");
			$data['background'] = $row['editor_background'];
	} else {
		$data['error'] = true;
	}
	
	echo json_encode($data);
?>