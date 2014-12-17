<?php
	require_once("XMLHandling.php");
	
	if(isset($_GET["log"]))
	{
		$log = $_GET["log"];
		$XMLfile = 'SettingFiles/userSettings.xml';
		logOut($log, $XMLfile);
		header("location:index.php");
	}
	else
	{
		echo("error all POST method variables does not exist...");
	}
	
	
	
	function logOut($log, $XMLfile)
	{
		$i = 0;
		
		if (file_exists($XMLfile))
		{
			
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			
			$root = $xml->documentElement;
			
			$currentSize = getSize($xml);
			
			for($i = 0; $i<$currentSize; $i++)
			{
				$user = $root->getElementsByTagName("user")->item($i);
				$userValue = $user->firstChild->nodeValue;
				if($userValue == $log)
				{
					$fil = $root->getElementsByTagName("fil")->item($i);
					removeValue($fil,$root);
					removeValue($user,$root);
					$size = $xml->getElementsByTagName("size")->item(0);
					$currentSize--;
					$size->firstChild->nodeValue = $currentSize;
					
				}
			}
			$xml->formatOutput=true;
			$xml->save($XMLfile);
		}
		
	}
?> 