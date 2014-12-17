<?php
	require_once("XMLHandling.php");
	
	//---Test if POST are set if not it could be a PHPUNIT test---//
	if(isset($_GET["log"]))
	{
		$log = $_GET["log"];
		$XMLfile = 'SettingFiles/userSettings.xml';
		//---Call the main function---//
		logOut($log, $XMLfile);
		
		//---Rerouting---//
		header("location:index.php");
	}
	else
	{
		echo("error all POST method variables does not exist...");
	}
	
	
	
	function logOut($log, $XMLfile)
	{
		$i = 0;
		
		//---if XML file exists---//
		if (file_exists($XMLfile))
		{
		
			//---Create and load XML file---//
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			
			$root = $xml->documentElement;
			
			$currentSize = getSize($xml);
			
			//---seek the user who will be deleted---//
			for($i = 0; $i<$currentSize; $i++)
			{
				$user = $root->getElementsByTagName("user")->item($i);
				$userValue = $user->firstChild->nodeValue;
				if($userValue == $log)
				{
					//---Remove XML child---//
					$fil = $root->getElementsByTagName("fil")->item($i);
					removeValue($fil,$root);
					removeValue($user,$root);
					
					//---Update number of user---//
					$size = $xml->getElementsByTagName("size")->item(0);
					$currentSize--;
					$size->firstChild->nodeValue = $currentSize;
					
				}
			}
			
			//---Save the XML file---//
			$xml->formatOutput=true;
			$xml->save($XMLfile);
		}
		
	}
?> 