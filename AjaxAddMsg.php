<?php
	require_once("XMLHandling.php");
	require_once("msgParsing.php");
	
	//---Test if POST are set if not it could be a PHPUNIT test---//
	if(isset($_POST["msg"]) && isset($_POST["date"]) && isset($_POST["user"]))
	{
		//---put HTML markup for smiley or other text processing---//
		$msgPost = parseText($_POST["msg"]);
		$date = $_POST["date"];
		$user = $_POST["user"];
		$XMLfile = 'SettingFiles/chatRoom.xml';
		addMsg($msgPost, $date, $user, $XMLfile);
	}
	else
	{
		echo("error all POST method variables does not exist...");
	}
	
	//--Add message function---//
	function addMsg($msgPost, $date, $user, $XMLfile)
	{
		$res = true;
		
		if (file_exists($XMLfile))
		{
			//---open a DOM doc and load a XML file in---//
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			$root = $xml->getElementsByTagName("root")->item(0);
			
			//---create child and add info on it---//
			$info = cElement($xml, "info", $root);
			AddValue($xml, "- ".$user." ".$date." :", $info);
			
			//---create child and add message on it---//
			$msg = cElement($xml, "msg", $root);
			
			//---CDATA allow the HTML markup in the XML markup---//
			AddValue($xml, "<![CDATA[".$msgPost."]]>", $msg);
			
			//---incrementation of the message number---//
			$size = $xml->getElementsByTagName("size")->item(0);
			$currentSize = $size->firstChild->nodeValue;
			$currentSize++;
			$size->firstChild->nodeValue = $currentSize;
			
			//---Save the XML file---//
			$xml->formatOutput=true;
			$xml->save($XMLfile);
		} 
		else
		{
			$res = false;
		}
		
		//---return add result---//
		return ($res);
	}
?> 