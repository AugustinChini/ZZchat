<?php

	//---Add child node---//
	function cElement($xml, $eName, $parent)
	{
		$node = $xml->createElement($eName);
		$parent->appendChild($node);
		return $node;
	}
	
	//---Add value on created node---//
	function AddValue($xml, $value, $parent)
	{
		$value = $xml->createTextNode($value);
		$parent->appendChild($value);
		return $value;
	}
	
	//---Remove child---//
	function removeValue($child, $parent)
	{
		$parent->removeChild($child);
	}
	
	//---Give the size node value---//
	function getSize($xml)
	{
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		return ($currentSize);
	}
?>