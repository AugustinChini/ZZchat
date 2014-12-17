<?php
	require_once("logOut.php");

	testInactivity();
	
	function testInactivity()
	{
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

			if(timeLapse($min))
			{
				echo("logout : ".$userValue."<br/>");
				logOut($userValue, $XMLfile);
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

		return ($min[1]);
	}
	
	function timeLapse($val)
	{
		$minutes = date("i");
		$timeLapse = ($minutes - $val);
		if($timeLapse < 0)
		{
			$res = 60 + $timeLapse;
		}
		else
		{
			$res = $timeLapse;
		}
		
		return ($res > 10);
	}
?> 