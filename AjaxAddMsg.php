<?php
	$msg = $_POST["msg"];
	$file = fopen('test.txt', 'w+'); 
	fputs($file, $msg);
?> 