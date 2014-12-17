<?php
	//---This PHP file is used to create a XML file which is a response to the AJAX query 
	//---(could contain User or msg information it depend on the Query type---//
	
	//---XML content type---//
	header("Content-type: text/xml");
	$QueryType = $_POST["type"];
	$size = 0;
	$XMLfile = "NULL";
	
	//---XML header---//
	echo "<?xml version='1.0' encoding='UTF-8'?><root>";
	
	//---Choose the XML file in function of the query type---//
	if($QueryType == "msgQuery")
	{
		$XMLfile = "SettingFiles/chatRoom.xml";
	}
	else
	{
		$XMLfile = "SettingFiles/userSettings.xml";
	}
	
	//---Create and load XML file---//
	$xml = new DOMDocument("1.0");
	$xml -> load($XMLfile);
	$root = $xml->getElementsByTagName("root")->item(0);
	
	$size = $xml->getElementsByTagName("size")->item(0)->nodeValue;
	
	//---Write all information asked by the query---//
	if($QueryType == "msgQuery")
	{
		$i = 0;
		for( $i = 0; $i<$size; ++$i)
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
