<?php
	require_once("logOut.php");

	//---Call the main function---//
	testInactivity();
	
	function testInactivity()
	{
		//---Create and load XML file---//
		$XMLfile = 'SettingFiles/userSettings.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		//---Catch the current number of user logged on---// 
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$i = 0;
		
		//---For each user check if they are inactive---//
		for($i = 0; $i<$currentSize; ++$i)
		{	
			$user = $xml->getElementsByTagName("user")->item($i);
			$userValue = $user->firstChild->nodeValue;
			
			//---get the number of minutes of the last message---//
			$min = getMin($userValue);
			
			//---Check if the time lapse between the last message and the current hour is > 10 min---//
			if(timeLapse($min))
			{
				//---Delete the user---//
				echo("logout : ".$userValue."<br/>");
				logOut($userValue, $XMLfile);
			}
		}
	}
	
	function getMin($user)
	{
		//---Create and load XML file---//
		$XMLfile = 'SettingFiles/chatRoom.xml';
		$find = false;

		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$i = 0;
		
		//---for loop with negative step to catch the last message---//
		for($i = $currentSize-1; $i>=0 && $find == false; --$i)
		{	
			$info = $xml->getElementsByTagName("info")->item($i);
			$infoValue = $info->firstChild->nodeValue;
			$name = explode(" ", $infoValue);
			
			//---Check if the message is wrote by the good user---//
			if($user == $name[1])
			{
				$find = true;
			}
		}
		
		//---Catch and return the minutes---//
		$min = explode(":", $infoValue);

		return ($min[1]);
	}
	
	function timeLapse($val)
	{
		//---Work out the time(in min) between the current date and $val ---//
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