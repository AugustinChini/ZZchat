<?php
	function cElement($xml, $eName, $parent)
	{
		$node = $xml->createElement($eName);
		$parent->appendChild($node);
		return $node;
	}
	
	function AddValue($xml, $value, $parent)
	{
		$value = $xml->createTextNode($value);
		$parent->appendChild($value);
		return $value;
	}
	function removeValue($child, $parent)
	{
		$parent->removeChild($child);
	}
	function getSize($xml)
	{
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize = $size->firstChild->nodeValue;
		return ($currentSize);
	}
?>