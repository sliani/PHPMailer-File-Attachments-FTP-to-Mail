<?php
// ftp_sync - copy directory and file structure
// based on http://www.php.net/manual/es/function.ftp-get.php#90910
// main function witch is called recursivly

// Change the values for deploye new project
require '../src/Models.php';

function ftp_sync($dir, $conn_id) {
	if ($dir !== '.') {
		if (ftp_chdir($conn_id, $dir) === FALSE) {
			echo 'Change dir failed: ' . $dir . PHP_EOL;
			return;
		}
		if (!(is_dir($dir))) {
			mkdir($dir);
		}
		chdir($dir);
	}
    $contents = ftp_nlist($conn_id, '.');
	foreach ($contents as $file) {
		if ($file == '.' || $file == '..') {
			continue;
		}
		if (@ftp_chdir($conn_id, $file)) {
			ftp_chdir($conn_id, "..");
			ftp_sync($file, $conn_id);
		} else {
			ftp_get($conn_id, $file, $file, FTP_BINARY);
		}
		
	}
	ftp_chdir($conn_id, '..');
	chdir('..');
}


// your settings
$ftp_server    = $ftp_s;
$user          = $ftp_login;
$password      = $ftp_pass;
$document_root = 'html';
$sync_path     = $sync_p;
// start copying
echo '<pre>' . PHP_EOL;
echo 'start copying....' . PHP_EOL;
$conn_id = ftp_connect($ftp_server);
if ($conn_id) {
	$login_result = ftp_login($conn_id, $user, $password);
	if ($login_result) {
		ftp_sync($sync_path, $conn_id);
		ftp_close($conn_id);

	} else {
		echo 'login to server failed!' . PHP_EOL;
	}
} else {
	echo 'connection to server failed!';
}
echo 'done.' . PHP_EOL;
?>