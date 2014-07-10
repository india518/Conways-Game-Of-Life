<?php
	session_start();

	//the only way we end up at this file is through the reset form.
	session_destroy();
	header('location: index.php');
?>