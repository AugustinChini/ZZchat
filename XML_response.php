<?php
	header("Content-type: text/xml");
	$QueryType = $_POST["type"];
	$size = 0;
	$XMLfile = "NULL";
	echo "<?xml version='1.0' encoding='UTF-8'?><root>";
	if($QueryType == "msgQuery")
	{
		$XMLfile = "SettingFiles/chatRoom.xml";
	}
	else
	{
		$XMLfile = "SettingFiles/userSettings.xml";
	}
	
	$xml = new DOMDocument("1.0");
	$xml -> load($XMLfile);
	$root = $xml->getElementsByTagName("root")->item(0);
	
	$size = $xml->getElementsByTagName("size")->item(0)->nodeValue;
	
	
	if($QueryType == "msgQuery")
	{
		$begin = $_POST["begin"];
		$i = 0;
		for( $i = $begin; $i<$size; ++$i)
		{
			$info = $xml->getElementsByTagName("info")->item($i);
			echo "<info>". $info->firstChild->nodeValue ."</info>";
			
			$msg = $xml->getElementsByTagName("msg")->item($i);
			echo "<msg>". $msg->firstChild->nodeValue ."</msg>";
		}
		$currentSize = $i - $begin;
		echo "<size>". $currentSize ."</size>";
		
	}
	else
	{
		$i = 0;
		echo "<size>". $size ."</size>";
		for( $i = 0; $i<$size; ++$i)
		{
			$user = $xml->getElementsByTagName("user")->item($i);
			echo "<user>". $user->firstChild->nodeValue ."</user>";
			
			$fil = $xml->getElementsByTagName("fil")->item($i);
			echo "<fil>". $fil->firstChild->nodeValue ."</fil>";
		}
	}
	
	
	echo "</root>";
?>
