<?php
	include("XMLHandling.php");
	
	$XMLfile = 'SettingFiles/chatRoom.xml';
	
	deleteOldMsg($XMLfile);
	
	function deleteOldMsg($XMLfile)
	{
		if (file_exists($XMLfile))
		{
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			
			$root = $xml->documentElement;
			
			for($i = 0; $i<30; ++$i)
			{
				$info = $root->getElementsByTagName("info")->item(0);
				$msg = $root->getElementsByTagName("msg")->item(0);
				removeValue($info,$root);
				removeValue($msg,$root);
			}
			$size = $xml->getElementsByTagName("size")->item(0);
			$size->firstChild->nodeValue -= 30; 
			
			$xml->formatOutput=true;
			$xml->save($XMLfile);
			
		}
	}
	
?> 