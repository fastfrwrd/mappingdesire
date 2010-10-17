<?php
$type = $_POST['type'];

$uploaddir = 'audio/'.$type.'/';
$uploadfile = $uploaddir . basename($_FILES[$type]['name']);

$rEFileTypes = "/^\.(mp3){1}$/i"; 

$isFile = is_uploaded_file($_FILES[$type]['tmp_name']);
if ($isFile) {	//  do we have a file?
	//  sanatize file name
	//     - remove extra spaces/convert to _,
	//     - remove non 0-9a-Z._- characters,
	//     - remove leading/trailing spaces
	//  check if under 5MB,
	//  check file extension for legal file types
	$safe_filename = preg_replace(
						array("/\s+/", "/[^-\.\w]+/"),
						array("_", ""),
						trim($_FILES[$type]['name']));
	if (preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
		
		$uploadfile = makeUnique($uploadfile);
		
		$isMove = move_uploaded_file (
	                 $_FILES[$type]['tmp_name'],
	                 $uploadfile);
		if ($isMove) {
			echo "success";
		} else {
			echo "error: could not move file.";
		}
	} else {
		echo "error: not a mp3 file.";
	}
} else {
	// WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
	// Otherwise onSubmit event will not be fired
	echo "error: file does not exist.";
}

function makeUnique($filename) {
		if( file_exists( $filename ) ) {
			$filename = str_replace(".mp3","",$filename);
			$filename .= "_1.mp3";
			return makeUnique($filename);
		} else {
			return $filename;
		}
}