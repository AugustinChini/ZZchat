<?php
	include("XMLHandling.php");
	include("msgParsing.php");
	
	$msgPost = "NULL";
	$date = "NULL";
	$user = "NULL";
	
	if(isset($_POST["msg"]) && isset($_POST["date"]) && isset($_POST["user"]))
	{
		$msgPost = parseText($_POST["msg"]);
		$date = $_POST["date"];
		$user = $_POST["user"];
	}
	else
	{
		echo("error all POST method variables does not exist...");
	}
	$XMLfile = 'SettingFiles/chatRoom.xml';
	
	addMsg($msgPost, $date, $user, $XMLfile);
	
	function addMsg($msgPost, $date, $user, $XMLfile)
	{
		$res = true;
		
		if (file_exists($XMLfile))
		{
			
			$xml = new DOMDocument("1.0");
			$xml -> load($XMLfile);
			$root = $xml->getElementsByTagName("root")->item(0);
			
			$info = cElement($xml, "info", $root);
			AddValue($xml, "- ".$user." ".$date." :", $info);
			
			$msg = cElement($xml, "msg", $root);
			AddValue($xml, "<![CDATA[".$msgPost."]]>", $msg);
			
			$size = $xml->getElementsByTagName("size")->item(0);
			$currentSize = $size->firstChild->nodeValue;
			$currentSize++;
			$size->firstChild->nodeValue = $currentSize;
			
			
			$xml->formatOutput=true;
			$xml->save($XMLfile);
		} 
		else
		{
			$res = false;
		}
		
		return ($res);
	}
?> 