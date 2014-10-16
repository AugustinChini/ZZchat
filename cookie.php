<?php 
	function cookie($log, $fil)
	{
		$cookie_name = "ZZchat";
		$cookie_value = "".$log.";".$fil."";
		return (setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"));
	}
?> 
