<?php
	include("logOut.php");

	testInactivity();
	
	function testInactivity()
	{	
		$heure = date("i");
		//$heure = 1;
		$XMLfile = 'SettingFiles/userSettings.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$i = 0;
		
		for($i = 0; $i<$currentSize; ++$i)
		{	
			$user = $xml->getElementsByTagName("user")->item($i);
			$userValue = $user->firstChild->nodeValue;
			$min = getMin($userValue);

			if(($heure - $min) > 10)
			{
				echo("logout : ".$userValue."<br/>");
				logOut($userValue);
			}
		}
	}
	
	function getMin($user)
	{
		
		$XMLfile = 'SettingFiles/chatRoom.xml';
		$find = false;

		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$i = 0;
		
		for($i = $currentSize-1; $i>=0 && $find == false; --$i)
		{	
			$info = $xml->getElementsByTagName("info")->item($i);
			$infoValue = $info->firstChild->nodeValue;
			$name = explode(" ", $infoValue);
			if($user == $name[1])
			{
				$find = true;
			}
		}
		
		$min = explode(":", $infoValue);

		return addMin($min[1]);
	}
	
	function addMin($val)
	{
		if(($val + 10) >= 60)
		{
			$val = $val - 60;
		}
		
		return $val;
	}
?> 