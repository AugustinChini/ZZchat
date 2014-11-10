<?php
	$msgPost = $_POST["msg"];
	$date = $_POST["date"];
	$user = $_POST["user"];
	$XMLfile = 'SettingFiles/chatRoom.xml';
	if (file_exists($XMLfile))
	{
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$root = $xml->getElementsByTagName("root")->item(0);
		
		$info = cElement("info", $root);
		cValue("- ".$user." ".$date." :", $info);
		
		$msg = cElement("msg", $root);
		cValue("$msgPost", $msg);
		
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		$currentSize++;
		$size->firstChild->nodeValue = $currentSize;
		
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
	} else
	{
		exit('Echec lors de l\'ouverture du fichier test.xml.');
	}
	
	function cElement($eName, $parent)
	{
		global $xml;
		$node = $xml->createElement($eName);
		$parent->appendChild($node);
		return $node;
	}
	
	function cValue($value, $parent)
	{
		global $xml;
		$value = $xml->createTextNode($value);
		$parent->appendChild($value);
		return $value;
	}
?> 