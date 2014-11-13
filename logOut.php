<?php
	include("XMLHandling.php");
	
	$log = $_GET["log"];
	$i = 0;
	$XMLfile = 'SettingFiles/userSettings.xml';
	if (file_exists($XMLfile))
	{
		
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$root = $xml->documentElement;
		
		$currentSize = getSize($xml);
		echo($currentSize);
		
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
	header("location:index.php");
	
?> 