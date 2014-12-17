<?php
	include("XMLHandling.php");
	
	$XMLfile = 'SettingFiles/chatRoom.xml';
	
	deleteOldMsg($XMLfile);
	
	//---Function which delete the 30 older messages---//
	function deleteOldMsg($XMLfile)
	{
		if (file_exists($XMLfile))
		{
			//---Create and load XML file---//
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			
			$root = $xml->documentElement;
			
			//---delete the 30 older messages and the information belong to them---//
			for($i = 0; $i<30; ++$i)
			{
				$info = $root->getElementsByTagName("info")->item(0);
				$msg = $root->getElementsByTagName("msg")->item(0);
				removeValue($info,$root);
				removeValue($msg,$root);
			}
			
			//---decrement the number of msg (-30)---//
			$size = $xml->getElementsByTagName("size")->item(0);
			$size->firstChild->nodeValue -= 30; 
			
			//---Save the XML file---///
			$xml->formatOutput=true;
			$xml->save($XMLfile);
			
		}
	}
	
?> 