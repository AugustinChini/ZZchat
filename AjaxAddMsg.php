<?php
	include("XMLHandling.php");
	
	$msgPost = $_POST["msg"];
	$date = $_POST["date"];
	$user = $_POST["user"];
	$XMLfile = 'SettingFiles/chatRoom.xml';
	if (file_exists($XMLfile))
	{
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$root = $xml->getElementsByTagName("root")->item(0);
		
		$info = cElement($xml, "info", $root);
		AddValue($xml, "- ".$user." ".$date." :", $info);
		
		$msg = cElement($xml, "msg", $root);
		AddValue($xml, "$msgPost", $msg);
		
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$currentSize++;
		$size->firstChild->nodeValue = $currentSize;
		
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
	} else
	{
		exit('Echec lors de l\'ouverture du fichier xml.');
	}
?> 